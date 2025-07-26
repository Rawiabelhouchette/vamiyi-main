<?php

namespace App\Livewire\Admin\FastFood;

use App\Livewire\Admin\AnnonceBaseCreate;
use App\Models\Annonce;
use App\Models\FastFood;
use App\Models\Entreprise;
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
    public $description;
    public $date_validite;
    public $entreprise_id;
    public $ingredient;

    public $prix_min;
    public $prix_max;

    public $produits_fast_food = [];
    public $list_produits_fast_food = [];

    public $equipements_restauration = [];
    public $list_equipements_restauration = [];

    public $entreprises = [];

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

        $tmp_produit_fast_food = Reference::where('slug_type', 'restauration')->where('slug_nom', 'produits-fast-food')->first();
        $tmp_produit_fast_food ?
            $this->list_produits_fast_food = ReferenceValeur::where('reference_id', $tmp_produit_fast_food->id)->select('valeur', 'id')->get() :
            $this->list_produits_fast_food = [];

        $tmp_equipement_restauration = Reference::where('slug_type', 'restauration')->where('slug_nom', 'equipements-restauration')->first();
        $tmp_equipement_restauration ?
            $this->list_equipements_restauration = ReferenceValeur::where('reference_id', $tmp_equipement_restauration->id)->select('valeur', 'id')->get() :
            $this->list_equipements_restauration = [];

    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|max:255|unique:annonces,titre,id,entreprise_id',
            'description' => 'nullable|min:3|max:255',
            'date_validite' => 'required|date|after:today',
            // 'ingredient' => 'nullable|string|min:3|max:255',
            'prix_min' => 'nullable|numeric|lt:prix_max',
            'prix_max' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'entreprise_id.required' => 'Le champ entreprise est obligatoire.',
            'entreprise_id.exists' => 'L\'entreprise sélectionnée n\'existe pas.',
            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.string' => 'Le champ nom doit être une chaîne de caractères.',
            'nom.min' => 'Le champ nom doit contenir au moins 3 caractères.',
            'nom.max' => 'Le champ nom ne doit pas dépasser 255 caractères.',
            'nom.unique' => 'Le nom de l\'annonce existe déjà.',
            'description.string' => 'Le champ description doit être une chaîne de caractères.',
            'description.min' => 'Le champ description doit contenir au moins 3 caractères.',
            'description.max' => 'Le champ description ne doit pas dépasser 255 caractères.',
            'date_validite.required' => 'Le champ date de validité est obligatoire.',
            'date_validite.date' => 'Le champ date de validité doit être une date.',
            'date_validite.after' => 'Le champ date de validité doit être une date supérieure à la date du jour.',
            // 'ingredient.string' => 'Le champ ingrédient doit être une chaîne de caractères.',
            // 'ingredient.min' => 'Le champ ingrédient doit contenir au moins 3 caractères.',
            // 'ingredient.max' => 'Le champ ingrédient ne doit pas dépasser 255 caractères.',
            'prix_min.numeric' => 'Le prix minimum doit être un nombre',
            'prix_max.numeric' => 'Le prix maximum doit être un nombre',
            'prix_min.lt' => 'Le prix minimum doit être inférieur au prix maximum',
            'prix_max.lt' => 'Le prix maximum doit être supérieur au prix minimum',

        ];
    }

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $fastFood = FastFood::create([
                'prix_min' => $this->prix_min,
                'prix_max' => $this->prix_max,
            ]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'type' => 'Fast-Food',
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
            ]);

            $fastFood->annonce()->save($annonce);

            $references = [
                ['Produits', $this->produits_fast_food],
                ['Equipements restauration', $this->equipements_restauration],
            ];

            AnnoncesUtils::createManyReference($annonce, $references);

            AnnoncesUtils::createGalerie($annonce, $this->image, $this->galerie, 'fast-foods');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération réussie'),
                'message' => __('Une erreur est survenue lors de l\'annonce'),
            ]);
            Log::error($th->getMessage());
            return;
        }

        session()->flash('success', 'L\'annonce a bien été ajoutée');
        return redirect()->route('fast-foods.create');
    }


    public function render()
    {
        return view('livewire.admin.fast-food.create');
    }
}
