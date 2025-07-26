<?php

namespace App\Livewire\Admin\Restaurant;

use App\Livewire\Admin\AnnonceBaseEdit;
use App\Models\Entreprise;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Utils\AnnoncesUtils;
use App\Utils\Utils;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Edit extends Component
{
    use WithFileUploads, AnnonceBaseEdit;

    public $restaurant;
    public $is_active;
    public $nom;
    public $type;
    public $description;
    public $date_validite;
    public $entreprise_id;

    public $e_nom;
    public $e_ingredients;
    public $e_prix_min = 0;
    public $e_prix_max = 0;

    public $p_nom;
    public $p_ingredients;
    public $p_accompagnements;
    public $p_prix_min = 0;
    public $p_prix_max = 0;

    public $d_nom;
    public $d_ingredients;
    public $d_prix_min = 0;
    public $d_prix_max = 0;


    public $entrees_error = '';
    public $entrees = [
        [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => ''
        ],
    ];
    public $entrees_count = 1;

    public $plats_error = '';
    public $plats = [
        [
            'nom' => '',
            'ingredients' => '',
            'accompagnements' => '',
            'prix_min' => '',
            'prix_max' => ''
        ],
    ];
    public $plats_count = 1;

    public $desserts_error = '';
    public $desserts = [
        [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => ''
        ],
    ];
    public $desserts_count = 1;


    public $equipements_restauration = [];
    public $list_equipements_restauration = [];

    public $specialites = [];
    public $list_specialites = [];

    public $carte_consommation = [];
    public $list_carte_consommation = [];


    public $entreprises = [];

    public function mount($restaurant)
    {
        $this->initialization();

        $this->restaurant = $restaurant;
        $this->nom = $restaurant->annonce->titre;
        $this->type = $restaurant->annonce->type;
        $this->description = $restaurant->annonce->description;
        $this->date_validite = date('Y-m-d', strtotime($restaurant->annonce->date_validite));
        $this->entreprise_id = $restaurant->annonce->entreprise_id;
        $this->is_active = $restaurant->annonce->is_active;

        $this->entrees = $restaurant->entrees;
        $this->entrees_count = count($this->entrees);

        $this->plats = $restaurant->plats;
        $this->plats_count = count($this->plats);

        $this->desserts = $restaurant->desserts;
        $this->desserts_count = count($this->desserts);

        $this->equipements_restauration = $restaurant->annonce->references('equipements-restauration')->pluck('id')->toArray();
        $this->specialites = $restaurant->annonce->references('specialites')->pluck('id')->toArray();
        $this->carte_consommation = $restaurant->annonce->references('carte-de-consommation')->pluck('id')->toArray();

        $this->old_galerie = $restaurant->annonce->galerie()->get();
        $this->old_image = $restaurant->annonce->imagePrincipale;
    }

    private function initialization()
    {
        if (\Auth::user()->hasRole('Professionnel')) {
            $this->entreprises = \Auth::user()->entreprises;
        } else {
            $this->entreprises = Entreprise::all();
        }

        $tmp_equipement_restauration = Reference::where('slug_type', 'restauration')->where('slug_nom', 'equipements-restauration')->first();
        $tmp_equipement_restauration ?
            $this->list_equipements_restauration = ReferenceValeur::where('reference_id', $tmp_equipement_restauration->id)->select('valeur', 'id')->get() :
            $this->list_equipements_restauration = [];

        $tmp_specialite = Reference::where('slug_type', 'restauration')->where('slug_nom', 'specialites')->first();
        $tmp_specialite ?
            $this->list_specialites = ReferenceValeur::where('reference_id', $tmp_specialite->id)->select('valeur', 'id')->get() :
            $this->list_specialites = [];

        $tmp_carte_consommation = Reference::where('slug_type', 'restauration')->where('slug_nom', 'carte-de-consommation')->first();
        $tmp_carte_consommation ?
            $this->list_carte_consommation = ReferenceValeur::where('reference_id', $tmp_carte_consommation->id)->select('valeur', 'id')->get() :
            $this->list_carte_consommation = [];
    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|unique:annonces,titre,' . $this->restaurant->annonce->id . ',id,entreprise_id,' . $this->entreprise_id,
            'description' => 'nullable|string|min:3',
            'date_validite' => 'required|date',
            'is_active' => 'required|boolean',
            // 'e_nom' => 'required|string|min:3',
            // 'e_ingredients' => 'nullable|string|min:3',
            // 'e_prix_min' => 'nullable|integer|min:0|lte:e_prix_max',
            // 'e_prix_max' => 'nullable|integer|min:0',
            // 'p_nom' => 'required|string|min:3',
            // 'p_ingredients' => 'nullable|string|min:3',
            // 'p_prix_min' => 'nullable|integer|min:0|lte:p_prix_max',
            // 'p_prix_max' => 'nullable|integer|min:0',
            // 'd_nom' => 'required|string|min:3',
            // 'd_ingredients' => 'nullable|string|min:3',
            // 'd_prix_min' => 'nullable|integer|min:0|lte:d_prix_max',
            // 'd_prix_max' => 'nullable|integer|min:0',
            'equipements_restauration' => 'nullable|array',
            'equipements_restauration.*' => 'nullable|integer|exists:reference_valeurs,id',
            'specialites' => 'nullable|array',
            'specialites.*' => 'nullable|integer|exists:reference_valeurs,id',
            'carte_consommation' => 'nullable|array',
            'carte_consommation.*' => 'nullable|integer|exists:reference_valeurs,id',
            'galerie' => 'nullable|array',
            'galerie.*' => 'nullable|image',

        ];
    }

    public function messages()
    {
        return [
            'entreprise_id.required' => __('Ce champ est obligatoire'),
            'entreprise_id.exists' => __('Cette entreprise n\'existe pas'),
            'nom.required' => __('Ce champ est obligatoire'),
            'nom.string' => __('Ce champ doit être une chaîne de caractères'),
            'nom.min' => __('Ce champ doit contenir au moins :min caractères'),
            'nom.unique' => __('Ce nom est déjà utilisé'),
            'description.string' => __('Ce champ doit être une chaîne de caractères'),
            'description.min' => __('Ce champ doit contenir au moins :min caractères'),
            'date_validite.required' => __('Ce champ est obligatoire'),
            'date_validite.date' => __('Ce champ doit être une date'),
            'is_active.required' => __('Ce champ est obligatoire'),
            'is_active.boolean' => __('Ce champ doit être un booléen'),
            'e_nom.required' => __('Ce champ est obligatoire'),
            'e_nom.string' => __('Ce champ doit être une chaîne de caractères'),
            'e_nom.min' => __('Ce champ doit contenir au moins :min caractères'),
            'e_ingredients.string' => __('Ce champ doit être une chaîne de caractères'),
            'e_ingredients.min' => __('Ce champ doit contenir au moins :min caractères'),
            'e_prix_min.integer' => __('Ce champ doit être un entier'),
            'e_prix_min.min' => __('Ce champ doit être supérieur ou égal à :min'),
            'e_prix_min.lte' => __('Ce champ doit être inférieur ou égal à :lte'),
            'e_prix_max.integer' => __('Ce champ doit être un entier'),
            'e_prix_max.min' => __('Ce champ doit être supérieur ou égal à :min'),
            'p_nom.required' => __('Ce champ est obligatoire'),
            'p_nom.string' => __('Ce champ doit être une chaîne de caractères'),
            'p_nom.min' => __('Ce champ doit contenir au moins :min caractères'),
            'p_ingredients.string' => __('Ce champ doit être une chaîne de caractères'),
            'p_ingredients.min' => __('Ce champ doit contenir au moins :min caractères'),
            'p_prix_min.integer' => __('Ce champ doit être un entier'),
            'p_prix_min.min' => __('Ce champ doit être supérieur ou égal à :min'),
            'p_prix_min.lte' => __('Ce champ doit être inférieur ou égal à :lte'),
            'p_prix_max.integer' => __('Ce champ doit être un entier'),
            'p_prix_max.min' => __('Ce champ doit être supérieur ou égal à :min'),
            'd_nom.required' => __('Ce champ est obligatoire'),
            'd_nom.string' => __('Ce champ doit être une chaîne de caractères'),
            'd_nom.min' => __('Ce champ doit contenir au moins :min caractères'),
            'd_ingredients.string' => __('Ce champ doit être une chaîne de caractères'),
            'd_ingredients.min' => __('Ce champ doit contenir au moins :min caractères'),
            'd_prix_min.integer' => __('Ce champ doit être un entier'),
            'd_prix_min.min' => __('Ce champ doit être supérieur ou égal à :min'),
            'd_prix_min.lte' => __('Ce champ doit être inférieur ou égal à :lte'),
            'd_prix_max.integer' => __('Ce champ doit être un entier'),
            'd_prix_max.min' => __('Ce champ doit être supérieur ou égal à :min'),
            'equipements_restauration.array' => __('Ce champ doit être un tableau'),
            'equipements_restauration.*.integer' => __('Ce champ doit être un entier'),
            'equipements_restauration.*.exists' => __('Cet équipement n\'existe pas'),
            'specialites.array' => __('Ce champ doit être un tableau'),
            'specialites.*.integer' => __('Ce champ doit être un entier'),
            'specialites.*.exists' => __('Cette spécialité n\'existe pas'),
            'carte_consommation.array' => __('Ce champ doit être un tableau'),
            'carte_consommation.*.integer' => __('Ce champ doit être un entier'),
            'carte_consommation.*.exists' => __('Cette carte de consommation n\'existe pas'),
            'galerie.array' => __('Ce champ doit être un tableau'),
            'galerie.*.image' => __('Ce champ doit être une image'),
        ];
    }

    public function addEntree()
    {
        // check if all fields are filled (entrees_count - 1) times
        $i = $this->entrees_count - 1;
        if (empty($this->entrees[$i]['nom']) || empty($this->entrees[$i]['ingredients']) || empty($this->entrees[$i]['prix_min']) || empty($this->entrees[$i]['prix_max'])) {
            $this->entrees_error = 'Veuillez remplir tous les champs de l\'entrée précédente';
            return;
        }

        // check if prix_min <= prix_max
        if ($this->entrees[$i]['prix_min'] > $this->entrees[$i]['prix_max']) {
            $this->entrees_error = 'Le prix minimum doit être inférieur ou égal au prix maximum';
            return;
        }

        // check if nom is unique
        foreach ($this->entrees as $key => $entree) {
            if ($key == $i)
                continue;
            if ($entree['nom'] == $this->entrees[$i]['nom']) {
                $this->entrees_error = 'Ce nom d\'entrée existe déjà';
                return;
            }
        }


        $this->entrees_error = '';

        $this->entrees[] = [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => '',
        ];

        $this->entrees_count++;
    }

    public function addDessert()
    {
        // check if all fields are filled (entrees_count - 1) times
        $i = $this->desserts_count - 1;
        if (empty($this->desserts[$i]['nom']) || empty($this->desserts[$i]['ingredients']) || empty($this->desserts[$i]['prix_min']) || empty($this->desserts[$i]['prix_max'])) {
            $this->desserts_error = 'Veuillez remplir tous les champs du dessert précédent';
            return;
        }

        // check if prix_min <= prix_max
        if ($this->desserts[$i]['prix_min'] > $this->desserts[$i]['prix_max']) {
            $this->desserts_error = 'Le prix minimum doit être inférieur ou égal au prix maximum';
            return;
        }

        // check if nom is unique
        foreach ($this->desserts as $key => $dessert) {
            if ($key == $i)
                continue;
            if ($dessert['nom'] == $this->desserts[$i]['nom']) {
                $this->desserts_error = 'Ce nom de dessert existe déjà';
                return;
            }
        }

        $this->desserts_error = '';

        $this->desserts[] = [
            'nom' => '',
            'ingredients' => '',
            'prix_min' => '',
            'prix_max' => '',
        ];

        $this->desserts_count++;
    }

    public function addPlat()
    {
        // check if all fields are filled (entrees_count - 1) times
        $i = $this->plats_count - 1;
        if (empty($this->plats[$i]['nom']) || empty($this->plats[$i]['ingredients']) || empty($this->plats[$i]['accompagnements']) || empty($this->plats[$i]['prix_min']) || empty($this->plats[$i]['prix_max'])) {
            $this->plats_error = 'Veuillez remplir tous les champs du plat précédent';
            return;
        }

        // check if prix_min <= prix_max
        if ($this->plats[$i]['prix_min'] > $this->plats[$i]['prix_max']) {
            $this->plats_error = 'Le prix minimum doit être inférieur ou égal au prix maximum';
            return;
        }

        // check if nom is unique
        foreach ($this->plats as $key => $plat) {
            if ($key == $i)
                continue;
            if ($plat['nom'] == $this->plats[$i]['nom']) {
                $this->plats_error = 'Ce nom de plat existe déjà';
                return;
            }
        }

        $this->plats_error = '';

        $this->plats[] = [
            'nom' => '',
            'ingredients' => '',
            'accompagnements' => '',
            'prix_min' => '',
            'prix_max' => '',
        ];

        $this->plats_count++;
    }

    public function removeEntree($key)
    {
        unset($this->entrees[$key]);
        $this->entrees_error = '';
        $this->entrees_count--;
    }

    public function removeDessert($key)
    {
        unset($this->desserts[$key]);
        $this->desserts_error = '';
        $this->desserts_count--;
    }

    public function removePlat($key)
    {
        unset($this->plats[$key]);
        $this->plats_error = '';
        $this->plats_count--;
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

        $separator = Utils::getRestaurantValueSeparator();

        // Put all entrees in the same variable
        foreach ($this->entrees as $entree) {
            $this->e_nom .= $entree['nom'] . $separator;
            $this->e_ingredients .= $entree['ingredients'] . $separator;
            $this->e_prix_min .= $entree['prix_min'] . $separator;
            $this->e_prix_max .= $entree['prix_max'] . $separator;
        }

        // Put all plats in the same variable
        foreach ($this->plats as $plat) {
            $this->p_nom .= $plat['nom'] . $separator;
            $this->p_ingredients .= $plat['ingredients'] . $separator;
            $this->p_accompagnements .= $plat['accompagnements'] . $separator;
            $this->p_prix_min .= $plat['prix_min'] . $separator;
            $this->p_prix_max .= $plat['prix_max'] . $separator;
        }

        // Put all desserts in the same variable
        foreach ($this->desserts as $dessert) {
            $this->d_nom .= $dessert['nom'] . $separator;
            $this->d_ingredients .= $dessert['ingredients'] . $separator;
            $this->d_prix_min .= $dessert['prix_min'] . $separator;
            $this->d_prix_max .= $dessert['prix_max'] . $separator;
        }

        try {
            DB::beginTransaction();

            $this->restaurant->annonce->update([
                'titre' => $this->nom,
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
                'is_active' => $this->is_active,
            ]);


            $this->restaurant->update([
                'e_nom' => $this->e_nom,
                'e_ingredients' => $this->e_ingredients,
                'e_prix_min' => $this->e_prix_min,
                'e_prix_max' => $this->e_prix_max,

                'p_nom' => $this->p_nom,
                'p_ingredients' => $this->p_ingredients,
                'p_prix_min' => $this->p_prix_min,
                'p_prix_max' => $this->p_prix_max,

                'd_nom' => $this->d_nom,
                'd_ingredients' => $this->d_ingredients,
                'd_prix_min' => $this->d_prix_min,
                'd_prix_max' => $this->d_prix_max,
            ]);

            $references = [
                ['Equipements restauration', $this->equipements_restauration],
                ['Specialités', $this->specialites],
                ['Carte de consommation', $this->carte_consommation],
            ];

            AnnoncesUtils::updateManyReference($this->restaurant->annonce, $references);

            AnnoncesUtils::updateGalerie($this->image, $this->restaurant->annonce, $this->galerie, $this->deleted_old_galerie, 'restaurants');

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

        session()->flash('success', __('La restaurant a bien été modifiée avec succès'));

        return redirect()->route('annonces.index');
    }

    public function render()
    {
        return view('livewire.admin.restaurant.edit');
    }
}
