<?php

namespace App\Livewire\Admin\Patisserie;

use App\Livewire\Admin\AnnonceBaseEdit;
use App\Models\Entreprise;
use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Utils\AnnoncesUtils;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Edit extends Component
{
    use WithFileUploads, AnnonceBaseEdit;

    public $nom;
    public $description;
    public $date_validite;
    public $entreprise_id;
    public $is_active;

    public $patisserie;

    public $ingredients;
    public $accompagnement;

    public $prix_min;
    public $prix_max;

    public $equipements_patisserie = [];
    public $list_equipements_patisserie = [];

    public $produits_patissiers = [];
    public $list_produits_patissiers = [];

    public $entreprises = [];


    public function mount($patisserie)
    {
        $this->initialization();

        $this->patisserie = $patisserie;
        $this->nom = $patisserie->annonce->titre;
        $this->description = $patisserie->annonce->description;
        $this->date_validite = date('Y-m-d', strtotime($patisserie->annonce->date_validite));
        $this->entreprise_id = $patisserie->annonce->entreprise_id;
        $this->is_active = $patisserie->annonce->is_active;

        $this->ingredients = $patisserie->ingredients;
        $this->accompagnement = $patisserie->accompagnement;
        $this->prix_min = $patisserie->prix_min;
        $this->prix_max = $patisserie->prix_max;

        $this->produits_patissiers = $patisserie->annonce->references('produits-patissiers')->pluck('id')->toArray();
        $this->equipements_patisserie = $patisserie->annonce->references('equipements-patisserie')->pluck('id')->toArray();

        $this->old_galerie = $patisserie->annonce->galerie()->get();
        $this->old_image = $patisserie->annonce->imagePrincipale;
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
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|unique:annonces,titre,' . $this->patisserie->annonce->id . ',id,entreprise_id,' . $this->entreprise_id,
            'description' => 'nullable|string|min:3',
            'date_validite' => 'required|date',
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

            $this->patisserie->annonce->update([
                'titre' => $this->nom,
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
                'is_active' => $this->is_active,
            ]);


            $this->patisserie->update([
                'ingredients' => $this->ingredients,
                'accompagnement' => $this->accompagnement,
                'prix_min' => $this->prix_min,
                'prix_max' => $this->prix_max,
            ]);

            $references = [
                ['Equipements patisserie', $this->equipements_patisserie],
                ['Produits patissiers', $this->produits_patissiers],
            ];

            AnnoncesUtils::updateManyReference($this->patisserie->annonce, $references);

            AnnoncesUtils::updateGalerie($this->image, $this->patisserie->annonce, $this->galerie, $this->deleted_old_galerie, 'patisseries');

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

        session()->flash('success', __('La patisserie a bien été modifiée avec succès'));

        return redirect()->route('annonces.index');
    }

    public function render()
    {
        return view('livewire.admin.patisserie.edit');
    }
}
