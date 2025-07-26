<?php

namespace App\Livewire\Admin\BoiteDeNuit;

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
    public $date_validite;
    public $entreprise_id;

    public $boiteDeNuit;

    public $commodites = [];
    public $list_commodites = [];

    public $services = [];
    public $list_services = [];

    public $types_musique = [];
    public $list_types_musique = [];

    public $equipements_vie_nocturne = [];
    public $list_equipements_vie_nocturne = [];

    public $entreprises = [];

    public $is_active;


    public function mount($boiteDeNuit)
    {
        $this->initialization();
        $this->boiteDeNuit = $boiteDeNuit;
        $this->entreprise_id = $boiteDeNuit->annonce->entreprise_id;
        $this->nom = $boiteDeNuit->annonce->titre;
        $this->is_active = $boiteDeNuit->annonce->is_active;
        $this->description = $boiteDeNuit->annonce->description;
        $this->date_validite = date('Y-m-d', strtotime($boiteDeNuit->annonce->date_validite));
        $this->commodites = $boiteDeNuit->annonce->references('commodites-hebergement')->pluck('id')->toArray();
        $this->services = $boiteDeNuit->annonce->references('services')->pluck('id')->toArray();
        $this->types_musique = $boiteDeNuit->annonce->references('types-de-musique')->pluck('id')->toArray();
        $this->equipements_vie_nocturne = $boiteDeNuit->annonce->references('equipements-vie-nocturne')->pluck('id')->toArray();
        $this->old_galerie = $boiteDeNuit->annonce->galerie()->get();
        $this->old_image = $boiteDeNuit->annonce->imagePrincipale;
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

        $tmp_services = Reference::where('slug_type', 'hebergement')->where('slug_nom', 'services')->first();
        $tmp_services ?
            $this->list_services = ReferenceValeur::where('reference_id', $tmp_services->id)->select('valeur', 'id')->get() :
            $this->list_services = [];

        $tmp_types_musique = Reference::where('slug_type', 'vie-nocturne')->where('slug_nom', 'types-de-musique')->first();
        $tmp_types_musique ?
            $this->list_types_musique = ReferenceValeur::where('reference_id', $tmp_types_musique->id)->select('valeur', 'id')->get() :
            $this->list_types_musique = [];

        $tmp_equipements_vie_nocturne = Reference::where('slug_type', 'vie-nocturne')->where('slug_nom', 'equipements-vie-nocturne')->first();
        $tmp_equipements_vie_nocturne ?
            $this->list_equipements_vie_nocturne = ReferenceValeur::where('reference_id', $tmp_equipements_vie_nocturne->id)->select('valeur', 'id')->get() :
            $this->list_equipements_vie_nocturne = [];
    }
    public function rules()
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'nom' => 'required|string|min:3|unique:annonces,titre,' . $this->boiteDeNuit->annonce->id . ',id,entreprise_id,' . $this->entreprise_id,
            'is_active' => 'required|boolean',
            'description' => 'nullable|min:3',
            'date_validite' => 'required|date',

            'commodites' => 'nullable',
            'services' => 'nullable',
            'types_musique' => 'nullable',
            'equipements_vie_nocturne' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'entreprise_id.required' => __('Veuillez choisir une entreprise'),
            'entreprise_id.exists' => __('Veuillez choisir une entreprise valide'),
            'nom.required' => __('Veuillez renseigner le nom de l\'boiteDeNuit'),
            'nom.string' => __('Le nom de l\'boiteDeNuit doit être une chaine de caractères'),
            'nom.min' => __('Le nom de l\'boiteDeNuit doit contenir au moins :min caractères'),
            'nom.max' => __('Le nom de l\'boiteDeNuit ne doit pas dépasser :max caractères'),
            'nom.unique' => __('Le nom de l\'boiteDeNuit est déjà utilisé'),
            'is_active.required' => __('Veuillez renseigner l\'état de l\'boiteDeNuit'),
            'is_active.boolean' => __('L\'état de l\'boiteDeNuit doit être soit vrai soit faux'),
            'description.min' => __('La description de l\'boiteDeNuit doit contenir au moins :min caractères'),
            'description.max' => __('La description de l\'boiteDeNuit ne doit pas dépasser :max caractères'),
            'date_validite.required' => __('Veuillez renseigner la date de validité de l\'boiteDeNuit'),
            'date_validite.date' => __('La date de validité de l\'boiteDeNuit doit être une date valide'),

            'commodites.*.exists' => __('Veuillez choisir une commodité valide'),
            'services.*.exists' => __('Veuillez choisir un service valide'),
            'types_musique.*.exists' => __('Veuillez choisir un type de musique valide'),
            'equipements_vie_nocturne.*.exists' => __('Veuillez choisir un équipement de vie nocturne valide'),
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

            $this->boiteDeNuit->annonce->update([
                'titre' => $this->nom,
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
                'is_active' => $this->is_active,
            ]);


            $this->boiteDeNuit->update([]);

            $references = [
                ['Types de musique', $this->types_musique],
                ['Equipements vie nocturne', $this->equipements_vie_nocturne],
                ['Commodités hébergement', $this->commodites],
                ['Services', $this->services],
            ];

            AnnoncesUtils::updateManyReference($this->boiteDeNuit->annonce, $references);

            AnnoncesUtils::updateGalerie($this->image, $this->boiteDeNuit->annonce, $this->galerie, $this->deleted_old_galerie, 'boite-de-nuits');

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

        // CHECKME : Est ce que les fichiers temporaires sont supprimés automatiquement apres 24h ?

        session()->flash('success', __('L\'annonce a été modifiée avec succès'));

        return redirect()->route('annonces.index');
    }

    public function render()
    {
        return view('livewire.admin.boite-de-nuit.edit');
    }
}
