<?php

namespace App\Livewire\Admin\LocationVehicule;

use App\Livewire\Admin\AnnonceBaseEdit;
use App\Utils\AnnoncesUtils;
use Livewire\Component;
use App\Models\Entreprise;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads, AnnonceBaseEdit;

    public $nom;
    public $type;
    public $description;
    public $marque;
    public $modele;
    public $annee;
    public $carburant;
    public $kilometrage;
    public $boite_vitesse;
    public $nombre_portes;
    public $nombre_places;
    public $is_active;
    public $locationVehicule;

    public $entreprise_id;
    public $entreprises = [];

    public $types_vehicule = [];
    public $list_types_vehicule = [];

    public $equipements_vehicule = [];
    public $list_equipements_vehicule = [];

    public $list_boites_vitesse = [];
    public $list_marques = [];
    public $list_types_carburant = [];

    public $conditions_location = [];
    public $list_conditions_location = [];

    public $date_validite;
    public $heure_validite;

    public function mount($locationVehicule)
    {
        $this->initialization();
        $this->locationVehicule = $locationVehicule;
        $this->entreprise_id = $locationVehicule->annonce->entreprise_id;
        $this->nom = $locationVehicule->annonce->titre;
        $this->description = $locationVehicule->annonce->description;
        $this->is_active = $locationVehicule->annonce->is_active;
        $this->date_validite = date('Y-m-d', strtotime($locationVehicule->annonce->date_validite));
        $this->annee = $locationVehicule->annee;
        $this->marque = $locationVehicule->marque;
        $this->modele = $locationVehicule->modele;
        $this->carburant = $locationVehicule->carburant;
        $this->kilometrage = $locationVehicule->kilometrage;
        $this->boite_vitesse = $locationVehicule->boite_vitesse;
        $this->nombre_portes = $locationVehicule->nombre_portes;
        $this->nombre_places = $locationVehicule->nombre_places;

        $this->types_vehicule = $locationVehicule->annonce->references('types-de-vehicule')->pluck('id')->toArray();
        $this->equipements_vehicule = $locationVehicule->annonce->references('equipements-vehicule')->pluck('id')->toArray();
        $this->conditions_location = $locationVehicule->annonce->references('conditions-de-location')->pluck('id')->toArray();

        $this->old_galerie = $locationVehicule->annonce->galerie()->get();
        $this->old_image = $locationVehicule->annonce->imagePrincipale;
    }

    private function initialization()
    {
        if (\Auth::user()->hasRole('Professionnel')) {
            $this->entreprises = \Auth::user()->entreprises;
        } else {
            $this->entreprises = Entreprise::all();
        }

        $tmp_type_vehicule = Reference::where('slug_type', 'location-de-vehicule')->where('slug_nom', 'types-de-vehicule')->first();
        $tmp_type_vehicule ?
            $this->list_types_vehicule = ReferenceValeur::where('reference_id', $tmp_type_vehicule->id)->select('valeur', 'id')->get() :
            $this->list_types_vehicule = [];

        $tmp_equipement_vehicule = Reference::where('slug_type', 'location-de-vehicule')->where('slug_nom', 'equipements-vehicule')->first();
        $tmp_equipement_vehicule ?
            $this->list_equipements_vehicule = ReferenceValeur::where('reference_id', $tmp_equipement_vehicule->id)->select('valeur', 'id')->get() :
            $this->list_equipements_vehicule = [];

        $tmp_boite_vitesse = Reference::where('slug_type', 'location-de-vehicule')->where('slug_nom', 'boite-de-vitesses')->first();
        $tmp_boite_vitesse ?
            $this->list_boites_vitesse = ReferenceValeur::where('reference_id', $tmp_boite_vitesse->id)->select('valeur', 'id')->get() :
            $this->list_boites_vitesse = [];

        $tmp_condition_location = Reference::where('slug_type', 'location-de-vehicule')->where('slug_nom', 'conditions-de-location')->first();
        $tmp_condition_location ?
            $this->list_conditions_location = ReferenceValeur::where('reference_id', $tmp_condition_location->id)->select('valeur', 'id')->get() :
            $this->list_conditions_location = [];

        $tmp_marque = Reference::where('slug_type', 'marque')->where('slug_nom', 'marques-de-vehicule')->first();
        $tmp_marque ?
            $this->list_marques = ReferenceValeur::where('reference_id', $tmp_marque->id)->select('valeur', 'id')->get() :
            $this->list_marques = [];

        $tmp_type_carburant = Reference::where('slug_type', 'location-de-vehicule')->where('slug_nom', 'types-de-carburant')->first();
        $tmp_type_carburant ?
            $this->list_types_carburant = ReferenceValeur::where('reference_id', $tmp_type_carburant->id)->select('valeur', 'id')->get() :
            $this->list_types_carburant = [];
    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|unique:annonces,titre,' . $this->locationVehicule->annonce->id . ',id,entreprise_id,' . $this->entreprise_id,
            'description' => 'required|string|min:3',
            'marque' => 'required|string|min:3',
            'modele' => 'nullable|string|min:3',
            'annee' => 'nullable|integer|min:1800|max:9999',
            'carburant' => 'nullable|string|exists:reference_valeurs,valeur',
            'kilometrage' => 'nullable|integer|min:0|max:999999',
            'boite_vitesse' => 'nullable|string|exists:reference_valeurs,valeur',
            'nombre_portes' => 'required|integer|min:1|max:20',
            'nombre_places' => 'nullable|integer|min:0|max:100',
            'types_vehicule' => 'nullable|array',
            'types_vehicule.*' => 'nullable|integer|exists:reference_valeurs,id',
            'equipements_vehicule' => 'nullable|array',
            'equipements_vehicule.*' => 'nullable|integer|exists:reference_valeurs,id',
            'conditions_location' => 'nullable|array',
            'conditions_location.*' => 'nullable|integer|exists:reference_valeurs,id',
            'galerie' => 'nullable|array|max:10',
        ];
    }

    public function messages()
    {
        return [
            'entreprise_id.required' => __('Veuillez choisir une entreprise'),
            'entreprise_id.exists' => __('Veuillez choisir une entreprise valide'),

            'nom.required' => __('Veuillez renseigner le nom'),
            'nom.string' => __('Nom invalide'),
            'nom.min' => __('Le nom doit contenir au moins :min caractères'),
            'nom.max' => __('Le nom doit contenir au maximum :max caractères'),
            'nom.unique' => __('Ce nom existe déjà'),

            'description.required' => __('Veuillez renseigner la description'),
            'description.string' => __('Description invalide'),
            'description.min' => __('La description doit contenir au moins :min caractères'),
            'description.max' => __('La description doit contenir au maximum :max caractères'),

            'marque.required' => __('Veuillez renseigner la marque'),
            'marque.string' => __('Marque invalide'),
            'marque.min' => __('La marque doit contenir au moins :min caractères'),
            'marque.max' => __('La marque doit contenir au maximum :max caractères'),

            'modele.string' => __('Modèle invalide'),
            'modele.min' => __('Le modèle doit contenir au moins :min caractères'),
            'modele.max' => __('Le modèle doit contenir au maximum :max caractères'),

            'annee.integer' => __('Année invalide'),
            'annee.min' => __('L\'année doit être supérieure ou égale à :min'),
            'annee.max' => __('L\'année doit être inférieure ou égale à :max'),

            'carburant.integer' => __('Type de carburant invalide'),
            'carburant.exists' => __('Type de carburant invalide'),

            'kilometrage.integer' => __('Kilométrage invalide'),
            'kilometrage.min' => __('Le kilométrage doit être supérieur ou égal à :min'),
            'kilometrage.max' => __('Le kilométrage doit être inférieur ou égal à :max'),

            'boite_vitesse.integer' => __('Boite de vitesse invalide'),
            'boite_vitesse.exists' => __('Boite de vitesse invalide'),

            'nombre_portes.integer' => __('Nombre de portes invalide'),
            'nombre_portes.min' => __('Le nombre de portes doit être supérieur ou égal à :min'),
            'nombre_portes.max' => __('Le nombre de portes doit être inférieur ou égal à :max'),
        ];
    }

    public function update()
    {
        $this->validate();

        if ($this->is_active && $this->date_validite < date('Y-m-d')) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération échouée'),
                'message' => __('La date de validité doit être supérieure à la date du jour'),
            ]);
            return;
        }

        try {
            DB::beginTransaction();

            $this->locationVehicule->annonce->update([
                'titre' => $this->nom,
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
                'is_active' => $this->is_active,
            ]);


            $this->locationVehicule->update([
                'marque' => $this->marque,
                'modele' => $this->modele,
                'annee' => $this->annee,
                'carburant' => $this->carburant,
                'kilometrage' => $this->kilometrage,
                'boite_vitesse' => $this->boite_vitesse,
                'nombre_portes' => $this->nombre_portes,
                'nombre_places' => $this->nombre_places,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
            ]);

            $references = [
                ['Types de véhicule', $this->types_vehicule],
                ['Equipements véhicule', $this->equipements_vehicule],
                ['Conditions de location', $this->conditions_location],
            ];

            AnnoncesUtils::updateManyReference($this->locationVehicule->annonce, $references);

            AnnoncesUtils::updateGalerie($this->image, $this->locationVehicule->annonce, $this->galerie, $this->deleted_old_galerie, 'location-vehicules');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération réussie'),
                'message' => __('Une erreur est survenue lors de la modification de l\'annonce'),
            ]);
            Log::error($th->getMessage());
            return;
        }

        // CHECKME : Est ce que les fichiers temporaires sont supprimés automatiquement apres 24h ?

        session()->flash('success', __('L\'annonce a été modifiée avec succès'));

        return redirect()->route('annonces.index');
    }

    public function render()
    {
        return view('livewire.admin.location-vehicule.edit');
    }
}
