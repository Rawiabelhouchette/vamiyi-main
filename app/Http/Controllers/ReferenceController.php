<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Utils\Reference as UtilsReference;
use App\Utils\References;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Afficher toutes les references
        $reference_valeurs = ReferenceValeur::all();
        return view('admin.reference.list', compact('reference_valeurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reference.add');
    }

    /**
     * Afficher le formulaire pour ajouter un nouveau nom de référence.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_name()
    {
        return view('admin.reference.add-nom');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verification des champs type, nom et valeur
        $request->validate([
            'type' => 'required|string',
            'nom' => 'required|string',
            'valeur' => 'required|string'
        ]);

        // Verifier si la combinaison type/nom existe
        $reference = Reference::where('type', $request->type)->where('nom', $request->nom)->first();
        if (!$reference) {
            return back()->with('error', 'Cette combinaison type/nom n\'existe pas.');
        }

        // Verifier si la combinaison valeur/ reference_id existe déjà
        $referenceValeur = ReferenceValeur::where('valeur', $request->valeur)->where('reference_id', $reference->id)->first();
        if ($referenceValeur) {
            return back()->with('error', 'Cette combinaison valeur/ reference_id existe déjà.');
        }

        // Enregistrer la nouvelle valeur de référence
        $referenceValeur = new ReferenceValeur();
        $referenceValeur->valeur = $request->valeur;
        $referenceValeur->reference_id = $reference->id;
        $referenceValeur->save();
        
        return back()->with('success', 'La référence a été ajoutée avec succès.');
    }

    /**
     * Enregistrer un nouveau nom de référence.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_name(Request $request)
    {
        // Valider les données
        $request->validate([
            'type' => 'required|string',
            'nom' => 'required|min:3'
        ]);

        // Verifier si la combinaison type/nom existe déjà
        $reference = Reference::where('type', $request->type)->where('nom', $request->nom)->first();
        if ($reference) {
            return back()->with('error', 'Cette combinaison type/nom existe déjà.');
        }

        // Enregistrer le nouveau nom de référence
        $reference = new Reference();
        $reference->type = $request->type;
        $reference->nom = $request->nom;
        $reference->save();

        return back()->with('success', 'Le nom de référence a été ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Edit a reference
        $reference_valeur = ReferenceValeur::find($id);
        return view('admin.reference.edit', compact('reference_valeur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Verification des champs type, nom et valeur
        $request->validate([
            'type' => 'required|string',
            'nom' => 'required|string',
            'valeur' => 'required|string'
        ]);

        // Verifier si la combinaison type/nom existe
        $reference = Reference::where('type', $request->type)->where('nom', $request->nom)->first();
        if (!$reference) {
            return back()->with('error', 'Cette combinaison type/nom n\'existe pas.');
        }

        // Verifier s'il y a eu une modification
        $referenceValeur = ReferenceValeur::find($id);
        if ($referenceValeur->valeur == $request->valeur) {
            return redirect()->route('references.index')->with('info', 'Aucune modification apportée.');
        }

        // Verifier si la combinaison valeur/ reference_id existe déjà
        $referenceValeur = ReferenceValeur::where('valeur', $request->valeur)->where('reference_id', $reference->id)->first();
        if ($referenceValeur) {
            return back()->with('error', 'Cette combinaison valeur/reference existe déjà.');
        }

        // Enregistrer la nouvelle valeur de référence
        $referenceValeur = ReferenceValeur::find($id);
        $referenceValeur->valeur = $request->valeur;
        $referenceValeur->save();

        return redirect()->route('references.index')->with('success', 'La référence a été modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Recuperer un nom de référence en fonction de son type
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_name($type)
    {
        // Récupérer les données correspondantes à la valeur envoyée
        $references = Reference::where('type', $type)->get();
        return $references;
    }

    public function getNameDataTable() {
        $perPage = request()->input('length') ?? 30;
        $references = Reference::latest();
        $columns = Schema::getColumnListing('references');


        if(request()->input('search')) {
            $search = request()->input('search');
            $references = $references->where(function ($query) use ($search, $columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            })
            ->orderBy('id', 'asc');
        }

        // if (request()->input('order.0.column')) {
        //     $orderColumn = request()->input('order.0.column');
        //     $orderDirection = request()->input('order.0.dir');
        //     $references = $references->orderBy($columns[$orderColumn], $orderDirection);
        // }
        
        $references = $references->with('user')->paginate($perPage);

        return response()->json(
            [
                'draw' => request()->get('draw'),
                'recordsTotal' => $references->total(),
                'recordsFiltered' => $references->total(),
                'metaData' => [
                    'total' => $references->total(),
                    'per_page' => $references->perPage(),
                    'current_page' => $references->currentPage(),
                    'last_page' => $references->lastPage(),
                    'from' => $references->firstItem(),
                    'to' => $references->lastItem(),
                ],
                'data' => $references->items(),
            ],
            200
        );
    }

    public function getDataTable() {
        $perPage = request()->input('length') ?? 30;
        $references = ReferenceValeur::latest();
        $columns = Schema::getColumnListing('reference_valeurs');


        if(request()->input('search')) {
            $search = request()->input('search');
            $references = $references->where(function ($query) use ($search, $columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            })
            ->orWhereHas('reference', function ($query) use ($search) {
                $query->where('type', 'like', '%' . $search . '%');
                $query->orWhere('nom', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'asc');
        }

        // if (request()->input('order.0.column')) {
        //     $orderColumn = request()->input('order.0.column');
        //     $orderDirection = request()->input('order.0.dir');
        //     $references = $references->orderBy($columns[$orderColumn], $orderDirection);
        // }
        $references = $references->with('reference', 'user');
        $references = $references->paginate($perPage);

        return response()->json(
            [
                'recordsTotal' => $references->total(),
                'recordsFiltered' => $references->total(),
                'data' => $references->items(),
            ],
            200
        );
    }

}


