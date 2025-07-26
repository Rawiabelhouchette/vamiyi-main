<?php

namespace App\Livewire\Admin\Patisserie;

use App\Livewire\Admin\AnnonceBaseCreate;
use App\Models\Annonce;
use App\Models\Entreprise;
use App\Models\Patisserie;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Utils\AnnoncesUtils;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Create extends Component
{
    use WithFileUploads, AnnonceBaseCreate;

    public $nom;
    public $type;
    public $description;
    public $date_validite;
    public $entreprise_id;

    public $ingredients;
    public $accompagnement;

    public $prix_min = 0;
    public $prix_max = 0;

    public $equipements_patisserie = [];
    public $list_equipements_patisserie = [];

    public $produits_patissiers = [];
    public $list_produits_patissiers = [];

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

        $tmp_equipement_patisserie = Reference::where('slug_type', 'restauration')->where('slug_nom', 'equipements-patisserie')->first();
        $tmp_equipement_patisserie ?
            $this->list_equipements_patisserie = ReferenceValeur::where('reference_id', $tmp_equipement_patisserie->id)->select('valeur', 'id')->get() :
            $this->list_equipements_patisserie = [];

        $tmp_produit_patissier = Reference::where('slug_type', 'restauration')->where('slug_nom', 'produits-patissiers')->first();
        $tmp_produit_patissier ?
            $this->list_produits_patissiers = ReferenceValeur::where('reference_id', $tmp_produit_patissier->id)->select('valeur', 'id')->get() :
            $this->list_produits_patissiers = [];
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|min:3',
            'description' => 'nullable|string|min:3',
            'date_validite' => 'required|date',
            'entreprise_id' => 'required|integer|exists:entreprises,id',
            'ingredients' => 'nullable|string|min:3',
            'accompagnement' => 'nullable|string|min:3',
            'equipements_patisserie' => 'nullable|array',
            'equipements_patisserie.*' => 'nullable|integer|exists:reference_valeurs,id',
            'produits_patissiers' => 'nullable|array',
            'produits_patissiers.*' => 'nullable|integer|exists:reference_valeurs,id',
            'galerie' => 'nullable|array',
            'galerie.*' => 'nullable|image',
            'prix_min' => 'nullable|numeric|lt:prix_max',
            'prix_max' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'nom.min' => 'Le nom doit contenir au moins :min caractères',
            'description.string' => 'La description doit être une chaîne de caractères',
            'description.min' => 'La description doit contenir au moins :min caractères',
            'date_validite.required' => 'La date de validité est obligatoire',
            'date_validite.date' => 'La date de validité doit être une date',
            'entreprise_id.required' => 'L\'entreprise est obligatoire',
            'entreprise_id.integer' => 'L\'entreprise doit être un nombre',
            'ingredients.string' => 'Les ingrédients doivent être une chaîne de caractères',
            'ingredients.min' => 'Les ingrédients doivent contenir au moins :min caractères',
            'accompagnement.string' => 'L\'accompagnement doit être une chaîne de caractères',
            'accompagnement.min' => 'L\'accompagnement doit contenir au moins :min caractères',
            'equipements_patisserie.array' => 'Les équipements de patisserie doivent être un tableau',
            'equipements_patisserie.*.integer' => 'Les équipements de patisserie doivent être des nombres',
            'equipements_patisserie.*.exists' => 'Les équipements de patisserie sélectionnés sont invalides',
            'produits_patissiers.array' => 'Les produits patissiers doivent être un tableau',
            'produits_patissiers.*.integer' => 'Les produits patissiers doivent être des nombres',
            'produits_patissiers.*.exists' => 'Les produits patissiers sélectionnés sont invalides',
            'galerie.array' => 'La galerie doit être un tableau',
            'galerie.*.image' => 'La galerie doit contenir des images',
            'prix_min.numeric' => 'Le prix minimum doit être un nombre',
            'prix_min.lt' => 'Le prix minimum doit être inférieur au prix maximum',
            'prix_max.numeric' => 'Le prix maximum doit être un nombre',
        ];
    }

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $patisserie = Patisserie::create([
                'ingredients' => $this->ingredients,
                'accompagnement' => $this->accompagnement,
                'prix_min' => $this->prix_min,
                'prix_max' => $this->prix_max,
            ]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'type' => 'Patisserie',
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
            ]);

            $patisserie->annonce()->save($annonce);

            $references = [
                ['Equipements patisserie', $this->equipements_patisserie],
                ['Produits patissiers', $this->produits_patissiers],
            ];

            AnnoncesUtils::createManyReference($annonce, $references);

            AnnoncesUtils::createGalerie($annonce, $this->image, $this->galerie, 'patisseries');

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
        return redirect()->route('patisseries.create');
    }

    public function render()
    {
        return view('livewire.admin.patisserie.create');
    }
}
