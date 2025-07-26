<?php

namespace App\Livewire\Admin\Bar;

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
    public $type;
    public $description;
    public $date_validite;
    public $entreprise_id;
    public $type_bar;
    public $type_musique;
    public $capacite_accueil;
    public $is_active;

    public $bar;

    public $prix_min;
    public $prix_max;

    public $equipements_vie_nocturne = [];
    public $list_equipements_vie_nocturne = [];

    public $commodites_vie_nocturne = [];
    public $list_commodites_vie_nocturne = [];

    public $entreprises = [];


    public function mount($bar)
    {
        $this->initialization();

        $this->bar = $bar;
        $this->nom = $bar->annonce->titre;
        $this->type = $bar->annonce->type;
        $this->description = $bar->annonce->description;
        $this->date_validite = date('Y-m-d', strtotime($bar->annonce->date_validite));
        $this->entreprise_id = $bar->annonce->entreprise_id;
        $this->type_bar = $bar->type_bar;
        $this->type_musique = $bar->type_musique;
        $this->capacite_accueil = $bar->capacite_accueil;
        $this->prix_min = $bar->prix_min;
        $this->prix_max = $bar->prix_max;
        $this->is_active = $bar->annonce->is_active;
        $this->old_galerie = $bar->annonce->galerie()->get();

        $this->equipements_vie_nocturne = $bar->annonce->references('equipements-vie-nocturne')->pluck('id')->toArray();
        $this->commodites_vie_nocturne = $bar->annonce->references('commodites-vie-nocturne')->pluck('id')->toArray();

        $this->old_image = $bar->annonce->imagePrincipale;
    }

    private function initialization()
    {
        if (\Auth::user()->hasRole('Professionnel')) {
            $this->entreprises = \Auth::user()->entreprises;
        } else {
            $this->entreprises = Entreprise::all();
        }

        $tmp_equipement_vie_nocturne = Reference::where('slug_type', 'vie-nocturne')->where('slug_nom', 'equipements-vie-nocturne')->first();
        $tmp_equipement_vie_nocturne ?
            $this->list_equipements_vie_nocturne = ReferenceValeur::where('reference_id', $tmp_equipement_vie_nocturne->id)->select('valeur', 'id')->get() :
            $this->list_equipements_vie_nocturne = [];

        $tmp_commodite_vie_nocturne = Reference::where('slug_type', 'vie-nocturne')->where('slug_nom', 'commodites-vie-nocturne')->first();
        $tmp_commodite_vie_nocturne ?
            $this->list_commodites_vie_nocturne = ReferenceValeur::where('reference_id', $tmp_commodite_vie_nocturne->id)->select('valeur', 'id')->get() :
            $this->list_commodites_vie_nocturne = [];
    }

    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|unique:annonces,titre,' . $this->bar->annonce->id . ',id,entreprise_id,' . $this->entreprise_id,
            'description' => 'nullable|string|min:3',
            'date_validite' => 'required|date',
            'type_bar' => 'nullable|string',
            'type_musique' => 'nullable|string',
            'capacite_accueil' => 'nullable|integer',
            'equipements_vie_nocturne' => 'nullable|array',
            'equipements_vie_nocturne.*' => 'nullable|integer|exists:reference_valeurs,id',
            'commodites_vie_nocturne' => 'nullable|array',
            'commodites_vie_nocturne.*' => 'nullable|integer|exists:reference_valeurs,id',
            'galerie' => 'nullable|array',
            'galerie.*' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'is_active' => 'required|boolean',
            'prix_min' => 'nullable|numeric|lt:prix_max',
            'prix_max' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'nom.min' => 'Le nom doit contenir au moins 3 caractères',
            'nom.unique' => 'Ce nom existe déjà',
            'description.string' => 'La description doit être une chaîne de caractères',
            'description.min' => 'La description doit contenir au moins 3 caractères',
            'date_validite.required' => 'La date de validité est obligatoire',
            'date_validite.date' => 'La date de validité doit être une date',
            'entreprise_id.required' => 'L\'entreprise est obligatoire',
            'entreprise_id.integer' => 'L\'entreprise doit être un entier',
            'entreprise_id.exists' => 'L\'entreprise n\'existe pas',
            'type_bar.string' => 'Le type de bar doit être une chaîne de caractères',
            'type_musique.string' => 'Le type de musique doit être une chaîne de caractères',
            'capacite_accueil.integer' => 'La capacité d\'accueil doit être un entier',
            'equipements_vie_nocturne.array' => 'Les équipements de vie nocturne doivent être un tableau',
            'equipements_vie_nocturne.*.integer' => 'Les équipements de vie nocturne doivent être des entiers',
            'equipements_vie_nocturne.*.exists' => 'Les équipements de vie nocturne n\'existent pas',
            'commodites_vie_nocturne.array' => 'Les commodités de vie nocturne doivent être un tableau',
            'commodites_vie_nocturne.*.integer' => 'Les commodités de vie nocturne doivent être des entiers',
            'commodites_vie_nocturne.*.exists' => 'Les commodités de vie nocturne n\'existent pas',
            'galerie.array' => 'La galerie doit être un tableau',
            'galerie.*.image' => 'La galerie doit contenir des images',
            'galerie.*.mimes' => 'La galerie doit contenir des images de type jpg, jpeg ou png uniquement',
            'galerie.*.max' => 'La galerie doit contenir des images de taille inférieure ou égale à 1 Mo',
            'is_active.required' => 'Le statut est obligatoire',
            'is_active.boolean' => 'Le statut doit être un booléen',
            'prix_min.numeric' => 'Le prix minimum doit être un nombre',
            'prix_max.numeric' => 'Le prix maximum doit être un nombre',
            'prix_min.lt' => 'Le prix minimum doit être inférieur au prix maximum',
            'prix_max.lt' => 'Le prix maximum doit être supérieur au prix minimum',
        ];
    }

    public function updatedIsActive()
    {
        // TODO : Mettre le controle de sorte qu'on puisse activer une annonce avec une date de validité inferieur à la date du jour
    }

    // public function updated

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

            $this->bar->annonce->update([
                'titre' => $this->nom,
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
                'is_active' => $this->is_active,
            ]);


            $this->bar->update([
                'type_bar' => $this->type_bar,
                'type_musique' => $this->type_musique,
                'capacite_accueil' => $this->capacite_accueil,
                'prix_min' => $this->prix_min,
                'prix_max' => $this->prix_max,
            ]);

            $references = [
                ['Equipements vie nocturne', $this->equipements_vie_nocturne],
                ['Commodités de vie nocturne', $this->commodites_vie_nocturne],
            ];


            AnnoncesUtils::updateManyReference($this->bar->annonce, $references);

            AnnoncesUtils::updateGalerie($this->image, $this->bar->annonce, $this->galerie, $this->deleted_old_galerie, 'bars');

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

        session()->flash('success', __('L\'bar a bien été modifiée avec succès'));

        return redirect()->route('annonces.index');
    }

    public function render()
    {
        return view('livewire.admin.bar.edit');
    }
}
