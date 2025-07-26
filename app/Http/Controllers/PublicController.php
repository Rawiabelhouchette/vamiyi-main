<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Entreprise;
use App\Models\Quartier;
use App\Utils\AnnoncesUtils;
use App\Utils\CustomSession;

class PublicController extends Controller
{
    public function home()
    {
        $listAnnonce = AnnoncesUtils::getPublicAnnonceList();
        $typeAnnonce = Annonce::public()->pluck('type')->unique()->toArray();
        $annonces = Annonce::public()->with('annonceable', 'entreprise')->inRandomOrder()->take(6)->get();

        // dd($annonces);
        $statsAnnonce = [];
        $quartiers = Quartier::getAllQuartiers();
        foreach ($typeAnnonce as $type) {
            $statsAnnonce[] = (object) [
                'type' => $type,
                'count' => Annonce::where('type', $type)->count()
            ];
        }

        // order by count
        usort($statsAnnonce, function ($a, $b) {
            return $a->count < $b->count;
        });

        CustomSession::reset();

        return view(
            'public.home',
            compact(
                'listAnnonce',
                'typeAnnonce',
                'annonces',
                'statsAnnonce',
                'quartiers'
            )
        );
    }

    public function showEntreprise($slug)
    {
        $entreprise = Entreprise::where('slug', $slug)->firstOrFail();
        $annonces = Annonce::public()->with('annonceable', 'entreprise')->where('entreprise_id', $entreprise->id)->take(4)->get();
        return view('public.company', compact('entreprise', 'annonces'));
    }
}
