<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Http\Requests\StoreAnnonceRequest;
use App\Http\Requests\UpdateAnnonceRequest;
use App\Utils\AnnoncesUtils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.annonce.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // check if entreprise has a quartier attribute
        if (Auth::user()->hasRole('Professionnel')) {
            $entrepises = Auth::user()->entreprises;
            // dd($entrepises);
            foreach ($entrepises as $entreprise) {
                if (!$entreprise->quartier_id) {
                    // if user is entreprise admin
                    if ($entreprise->pivot->is_admin) {
                        // return redirect()->route('entreprises.edit', $entreprise->id)->with('error', 'Veuillez renseigner le quartier de votre entreprise');
                        return redirect()->route('entreprises.edit', $entreprise->id)->with('error', 'Veuillez compléter les informations de votre entreprise');
                    } else {
                        return redirect()->back()->with('error', 'Veuillez compléter les informations de votre entreprise');
                    }
                }
            }
        }

        $typeAnnonces = AnnoncesUtils::getAnnonceList();
        return view('admin.annonce.create', compact('typeAnnonces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnonceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Annonce $annonce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Annonce $annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnonceRequest $request, Annonce $annonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annonce $annonce)
    {
        //
    }

    public function getDataTable()
    {
        $perPage = request()->input('length') ?? 30;
        if (Auth::user()->hasRole('Professionnel')) {
            $annonces = Auth::user()->annonces();
        } else {
            $annonces = Annonce::with('entreprise', 'annonceable')->latest();
        }

        $columns = Schema::getColumnListing('annonces');

        if (request()->input('search')) {
            $search_columns = ['titre', 'description', 'type', 'date_validite'];
            $search = request()->input('search');
            $annonces = $annonces
                ->where(function ($query) use ($search, $columns, $search_columns) {
                    foreach ($search_columns as $column) {
                        $query->orWhereRaw("LOWER({$column}) LIKE ?", ['%' . Str::lower($search) . '%']);
                    }

                    $query->orWhereHas('entreprise', function ($query) use ($search) {
                        $query->whereRaw("LOWER(nom) LIKE ?", ['%' . Str::lower($search) . '%']);
                    });

                    if (Str::lower($search) == 'actif') {
                        $query->orWhere('is_active', true);
                    } elseif (Str::lower($search) == 'inactif') {
                        $query->orWhere('is_active', false);
                    }
                })
                ->orderBy('id', 'asc');
        }
        $annonces = $annonces->paginate($perPage);

        return response()->json(
            [
                'recordsTotal' => $annonces->total(),
                'recordsFiltered' => $annonces->total(),
                'data' => $annonces->items(),
            ],
            200,
        );
    }
}
