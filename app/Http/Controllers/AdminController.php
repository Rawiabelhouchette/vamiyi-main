<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\Annonce;
use App\Models\Document;
use App\Models\Entreprise;
use App\Models\Message;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function welcome()
    {
        $sexes = null;//Reference::where('type', 'Comptes')->where('nom', 'Sexe')->first();
        return view('welcome', compact('sexes'));
    }


    public function home()
    {
        $annonces = [];
        $elements = [];

        if (Auth::user()->hasRole('Professionnel')) {
            $annonces = Auth::user()->annonces();
            $lastDateAbonnement = Auth::user()->abonnements()->orderBy('date_fin', 'desc')->first();

            $elements = [
                [
                    'id' => 'annonce',
                    'nombre' => $annonces->public()->count(),
                    'nom' => 'Annonces',
                    'lien' => route('annonces.index'),
                    'icon' => 'fa-solid fa-book'
                ],
                [
                    'id' => 'fin-abonnement',
                    'nombre' => "<span style='font-size: 25px;'>" . date('d/m/Y', strtotime($lastDateAbonnement->date_fin)) . "</span>",
                    'nom' => 'Fin aboonnement',
                    'lien' => route('abonnements.index'),
                    'icon' => 'fa-solid fa-calendar',
                    'couleur' => strtotime($lastDateAbonnement->date_fin) > time() ? '#33FF57' : '#FF8733' // Couleur verte si l'abonnement est actif, rouge sinon
                ]
            ];
        }

        if (Auth::user()->hasRole('Administrateur')) {
            $annonces = Annonce::with('entreprise', 'annonceable');

            $elements = [
                [
                    'id' => 'annonce',
                    'nombre' => $annonces->public()->count(),
                    'nom' => 'Annonces',
                    'lien' => route('annonces.index'),
                    'icon' => 'fa-solid fa-book',
                    'couleur' => '#3390FF'
                ],
                [
                    'id' => 'abonnements',
                    'nombre' => Abonnement::where('is_active', true)->count(),
                    'nom' => 'Abonnements actifs',
                    'lien' => route('abonnements.index'),
                    'icon' => 'fa-solid fa-calendar'
                ],
                [
                    'id' => 'entreprises',
                    'nombre' => Entreprise::count(),
                    'nom' => 'Entreprises',
                    'lien' => route('entreprises.index'),
                    'icon' => 'fa-solid fa-building'
                ],
                [
                    'id' => 'comptes-usagers',
                    'nombre' => User::whereHas('roles', function ($query) {
                        $query->where('name', 'Usager');
                    })->count(),
                    'nom' => 'Comptes Usagers',
                    'lien' => route('users.index'),
                    'icon' => 'fa-solid fa-user'
                ],
                [
                    'id' => 'comptes-professionnels',
                    'nombre' => User::whereHas('roles', function ($query) {
                        $query->where('name', 'Professionnel');
                    })->count(),
                    'nom' => 'Comptes Professionnels',
                    'lien' => route('users.index'),
                    'icon' => 'fa-solid fa-users'
                ],
                [
                    // nombre de comptes professionnels
                    'id' => 'comptes-administrateurs',
                    'nombre' => User::whereHas('roles', function ($query) {
                        $query->where('name', 'Administrateur');
                    })->count(),
                    'nom' => 'Comptes Admin',
                    'lien' => route('users.index'),
                    'icon' => 'fa-solid fa-user-shield'
                ],
            ];
        }

        if (auth()->user()->hasRole('Usager')) {
            return redirect()->route('accounts.index');
        }

        return view('admin.dashboard', compact('elements'));
    }
}
