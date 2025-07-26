<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOffreAbonnementRequest;
use App\Models\Abonnement;
use App\Models\Entreprise;
use App\Models\OffreAbonnement;
use App\Models\User;
use App\Services\Paiement\PaiementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Log;

class AbonnementController extends Controller
{
    public function index()
    {
        return view('admin.abonnement.index');
    }

    public function create()
    {
        $offres = OffreAbonnement::all();
        return view('admin.abonnement.create', compact('offres'));
    }

    public function store(StoreOffreAbonnementRequest $request)
    {
        // dd(1);
        // UNUSED

        // TO USE FOR REGISTER A SUBSCRIPTIN IN LOCAL (TEST METHOD)
        $request->validated();

        DB::beginTransaction();

        try {
            // create entreprise
            $entreprise = Entreprise::create([
                'nom' => $request->nom_entreprise,
                'telephone' => $request->numero_telephone,
                'whatsapp' => $request->numero_whatsapp,
            ]);

            // set the user entreprise_id
            auth()->user()->entreprises()->attach($entreprise->id, [
                'is_admin' => true,
                'is_active' => true,
                'date_debut' => now(),
            ]);

            // create a new abonnement
            $abonnement = Abonnement::create([
                'offre_abonnement_id' => $request->offre_id,
                'montant' => OffreAbonnement::find($request->offre_id)->prix,
                'date_debut' => now(),
                'date_fin' => now()->addMonths(OffreAbonnement::find($request->offre_id)->duree),
            ]);

            // link the abonnement to the entreprise
            $abonnement->entreprises()->attach($entreprise->id);

            // Get the user
            $user = User::find(auth()->id());

            // remove role Usager
            $user->removeRole('Usager');
            $user->assignRole('Professionnel');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement de votre abonnement');
        }

        return redirect()->route('home');
    }

    // redirection vers la page de choix d'abonnement
    public function choiceIndex(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('connexion');
        }

        if (!auth()->user()->hasRole('Usager') && (auth()->user()->hasRole('Professionnel') || auth()->user()->hasRole('Administrateur'))) {
            return redirect()->route('abonnements.create');
        }

        $offres = OffreAbonnement::active()->get();
        return view('public.pricing', compact('offres'));
    }

    // operation de validation avant l'abonnement
    public function checkPayment(StoreOffreAbonnementRequest $request)
    {
        $validated = $request->validated();
        session()->put('abonnement', $validated);
        return redirect()->route('payments.index');
    }

    public function getDataTable()
    {
        $perPage = request()->input('length') ?? 30;
        if (\Auth::user()->hasRole('Professionnel')) {
            $abonnements = \Auth::user()->abonnements();
        } else {
            $abonnements = Abonnement::with('offre', 'entreprises')->latest();
        }

        $columns = Schema::getColumnListing('abonnements');

        if (request()->input('search')) {
            $search_columns = ['date_debut', 'date_fin'];
            $search = request()->input('search');
            $abonnements = $abonnements
                ->where(function ($query) use ($search, $columns, $search_columns) {
                    // foreach ($search_columns as $column) {
                    //     $query->orWhereRaw("LOWER({$column}) LIKE ?", ['%' . Str::lower($search) . '%']);
                    // }
    
                    // $query->orWhereHas('entreprises', function ($query) use ($search) {
                    //     $query->whereRaw("LOWER(nom) LIKE ?", ['%' . Str::lower($search) . '%']);
                    // });
    
                    // $query->orWhereHas('offre', function ($query) use ($search) {
                    //     $query->whereRaw("LOWER(libelle) LIKE ?", ['%' . Str::lower($search) . '%']);
                    // });
    
                    // if (Str::lower($search) == 'actif') {
                    //     $query->orWhere('is_active', true);
                    // } elseif (Str::lower($search) == 'inactif') {
                    //     $query->orWhere('is_active', false);
                    // }
                })
                ->orderBy('id', 'asc');
        }
        $abonnements = $abonnements->paginate($perPage);

        return response()->json(
            [
                'recordsTotal' => $abonnements->total(),
                'recordsFiltered' => $abonnements->total(),
                'data' => $abonnements->items(),
            ],
            200,
        );
    }
}
