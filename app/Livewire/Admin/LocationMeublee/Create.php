<?php

namespace App\Livewire\Admin\LocationMeublee;

use App\Livewire\Admin\AnnonceBaseCreate;
use App\Models\Annonce;
use App\Models\Entreprise;
use App\Models\LocationMeublee;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Utils\AnnoncesUtils;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, AnnonceBaseCreate;

    public $nom;
    public $type;
    public $types_hebergement;
    public $description;
    public $nombre_chambre;
    public $nombre_personne;
    public $nombre_salles_bain;
    public $superficie;
    public $prix_min;
    public $prix_max;
    public $entreprise_id;
    public $entreprises = [];
    public $types_lit = [];
    public $list_types_lit = [];
    public $commodites = [];
    public $list_commodites = [];
    public $services = [];
    public $list_services = [];
    public $equipements_herbegement = [];
    public $list_equipements_herbegement = [];
    public $equipements_salle_bain = [];
    public $list_equipements_salle_bain = [];
    public $equipements_cuisine = [];
    public $list_equipements_cuisine = [];
    public $list_types_hebergement = [];
    public $date_validite;
    public $heure_validite;

    public function mount()
    {
        $this->initialization();
    }

    private function initialization()
    {
        if (\Auth::user()->hasRole('Professionnel')) {
            $this->entreprises = \Auth::user()->entreprises;
        } else {
            $this->entreprises = Entreprise::all();
        }

        $tmp_commodite = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'commodites-hebergement')->first();
        $tmp_commodite ?
            $this->list_commodites = ReferenceValeur::where('reference_id', $tmp_commodite->id)->select('valeur', 'id')->get() :
            $this->list_commodites = [];

        $tmp_types_lit = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'types-de-lit')->first();
        $tmp_types_lit ?
            $this->list_types_lit = ReferenceValeur::where('reference_id', $tmp_types_lit->id)->select('valeur', 'id')->get() :
            $this->list_types_lit = [];

        $tmp_services = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'services')->first();
        $tmp_services ?
            $this->list_services = ReferenceValeur::where('reference_id', $tmp_services->id)->select('valeur', 'id')->get() :
            $this->list_services = [];

        $tmp_equipements_herbegement = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'equipements-hebergement')->first();
        $tmp_equipements_herbegement ?
            $this->list_equipements_herbegement = ReferenceValeur::where('reference_id', $tmp_equipements_herbegement->id)->select('valeur', 'id')->get() :
            $this->list_equipements_herbegement = [];

        $tmp_equipements_salle_bain = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'equipements-salle-de-bain')->first();
        $tmp_equipements_salle_bain ?
            $this->list_equipements_salle_bain = ReferenceValeur::where('reference_id', $tmp_equipements_salle_bain->id)->select('valeur', 'id')->get() :
            $this->list_equipements_salle_bain = [];

        $tmp_equipements_cuisine = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'equipements-cuisine')->first();
        $tmp_equipements_cuisine ?
            $this->list_equipements_cuisine = ReferenceValeur::where('reference_id', $tmp_equipements_cuisine->id)->select('valeur', 'id')->get() :
            $this->list_equipements_cuisine = [];

        $tmp_types_hebergement = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'types-hebergement')->first();
        $tmp_types_hebergement ?
            $this->list_types_hebergement = ReferenceValeur::where('reference_id', $tmp_types_hebergement->id)->select('valeur', 'id')->get() :
            $this->list_types_hebergement = [];

    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|unique:annonces,titre,id,entreprise_id',
            'type' => 'nullable',
            'description' => 'nullable|min:3',
            'nombre_chambre' => 'required|numeric',
            'nombre_personne' => 'nullable|numeric',
            'superficie' => 'nullable|numeric',
            'types_lit' => 'required',
            'commodites' => 'nullable',
            'services' => 'nullable',
            'equipements_herbegement' => 'nullable',
            'equipements_salle_bain' => 'nullable',
            'equipements_cuisine' => 'required',
            'galerie.*' => 'image',//|max:5120',
            // 'galerie' => 'max:10',
            'date_validite' => 'required|date|after:today',
            // 'heure_validite' => 'required|date_format:H:i',
            'prix_min' => 'nullable|numeric|lt:prix_max',
            'prix_max' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'entreprise_id.required' => __('Veuillez choisir une entreprise'),
            'entreprise_id.exists' => __('L\'entreprise choisi n\'existe pas'),
            'nom.required' => __('Veuillez renseigner le nom de la location meublée'),
            'nom.string' => __('Le nom de la location meublée doit être une chaine de caractères'),
            'nom.min' => __('Le nom de la location meublée doit contenir au moins :min caractères'),
            'nom.max' => __('Le nom de la location meublée ne doit pas dépasser :max caractères'),
            'nom.unique' => __('Ce nom est déjà utilisé'),
            'type.required' => __('Veuillez choisir un type da location meublée'),
            'description.min' => __('La description de la location meublée doit contenir au moins :min caractères'),
            'description.max' => __('La description de la location meublée ne doit pas dépasser :max caractères'),
            'nombre_chambre.required' => __('Veuillez renseigner le nombre de chambre(s) de la location meublée'),
            'nombre_chambre.numeric' => __('Le nombre de chambre(s) de la location meublée doit être un nombre'),
            'nombre_personne.numeric' => __('Le nombre de personne(s) de la location meublée doit être un nombre'),
            'superficie.numeric' => __('La superficie de la location meublée doit être un nombre'),
            'types_lit.required' => __('Veuillez choisir au moins un type de lit'),
            'commodites.required' => __('Veuillez choisir au moins une commodité'),
            'services.required' => __('Veuillez choisir au moins un service'),
            'equipements_herbegement.required' => __('Veuillez choisir au moins un équipement d\'hébergement'),
            'equipements_salle_bain.required' => __('Veuillez choisir au moins un équipement de salle de bain'),
            'equipements_cuisine.required' => __('Veuillez choisir au moins un équipement de cuisine'),
            'prix_min.numeric' => 'Le prix minimum doit être un nombre',
            'prix_max.numeric' => 'Le prix maximum doit être un nombre',
            'prix_min.lt' => 'Le prix minimum doit être inférieur au prix maximum',
            'prix_max.gt' => 'Le prix maximum doit être supérieur au prix minimum',
        ];
    }

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $date_validite = $this->date_validite . ' ' . $this->heure_validite;

            $hotel = LocationMeublee::create([
                'nombre_chambre' => $this->nombre_chambre,
                'nombre_personne' => $this->nombre_personne,
                'superficie' => $this->superficie,
                'prix_min' => $this->prix_min,
                'prix_max' => $this->prix_max,
                'nombre_salles_bain' => $this->nombre_salles_bain,
            ]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'type' => 'Location meublée',
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
            ]);

            $hotel->annonce()->save($annonce);

            $references = [
                ['Types de lit', $this->types_lit],
                ['Commodités hébergement', $this->commodites],
                ['Services', $this->services],
                ['Equipements hébergement', $this->equipements_herbegement],
                ['Equipements salle de bain', $this->equipements_salle_bain],
                ['Equipements cuisine', $this->equipements_cuisine],
                ['Types hébergement', $this->types_hebergement],
            ];

            AnnoncesUtils::createManyReference($annonce, $references);

            AnnoncesUtils::createGalerie($annonce, $this->image, $this->galerie, 'location-meublees');


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération réussie'),
                'message' => __('Une erreur est survenue lors de l\'ajout de l\'annonce'),
            ]);
            Log::error($th->getMessage());
            return;
        }

        // CHECKME : Est ce que les fichiers temporaires sont supprimés automatiquement apres 24h ?

        session()->flash('success', 'L\'annonce a bien été ajoutée');
        return redirect()->route('location-meublees.create');
    }


    public function render()
    {
        return view('livewire.admin.location-meublee.create');
    }
}
