<?php

namespace App\Livewire\Admin\Bar;

use App\Livewire\Admin\AnnonceBaseCreate;
use App\Models\Annonce;
use App\Models\Bar;
use App\Models\Entreprise;
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
    public $type_bar;
    public $type_musique;
    public $capacite_accueil;

    public $prix_min = 0;
    public $prix_max = 0;

    public $equipements_vie_nocturne = [];
    public $list_equipements_vie_nocturne = [];

    public $commodites_vie_nocturne = [];
    public $list_commodites_vie_nocturne = [];

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
            'nom' => 'required|string|min:3',
            'description' => 'nullable|string|min:3',
            'date_validite' => 'required|date',
            'entreprise_id' => 'required|integer|exists:entreprises,id',
            'type_bar' => 'nullable|string',
            'type_musique' => 'nullable|string',
            'capacite_accueil' => 'nullable|integer',
            'equipements_vie_nocturne' => 'nullable|array',
            'equipements_vie_nocturne.*' => 'nullable|integer|exists:reference_valeurs,id',
            'commodites_vie_nocturne' => 'nullable|array',
            'commodites_vie_nocturne.*' => 'nullable|integer|exists:reference_valeurs,id',
            'galerie' => 'nullable|array',
            'galerie.*' => 'nullable|image|max:1024',
            'prix_min' => 'nullable|numeric|lt:prix_max',
            'prix_max' => 'nullable|numeric',
            // 'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'nom.min' => 'Le nom doit contenir au moins 3 caractères',

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

            'equipements_vie_nocturne.required' => 'Les équipements de vie nocturne sont obligatoires',
            'equipements_vie_nocturne.array' => 'Les équipements de vie nocturne doivent être un tableau',
            'equipements_vie_nocturne.*.required' => 'Un équipement de vie nocturne est obligatoire',
            'equipements_vie_nocturne.*.integer' => 'Un équipement de vie nocturne doit être un entier',
            'equipements_vie_nocturne.*.exists' => 'Un équipement de vie nocturne n\'existe pas',

            'commodites_vie_nocturne.required' => 'Les commodités de vie nocturne sont obligatoires',
            'commodites_vie_nocturne.array' => 'Les commodités de vie nocturne doivent être un tableau',
            'commodites_vie_nocturne.*.required' => 'Une commodité de vie nocturne est obligatoire',
            'commodites_vie_nocturne.*.integer' => 'Une commodité de vie nocturne doit être un entier',
            'commodites_vie_nocturne.*.exists' => 'Une commodité de vie nocturne n\'existe pas',
            'galerie.required' => 'La galerie est obligatoire',
            'galerie.array' => 'La galerie doit être un tableau',
            'galerie.*.required' => 'Une image de la galerie est obligatoire',
            'galerie.*.image' => 'Une image de la galerie doit être une image',
            'galerie.*.max' => 'Une image de la galerie ne doit pas dépasser 1 Mo',
            'prix_min.numeric' => 'Le prix minimum doit être un nombre',
            'prix_min.lt' => 'Le prix minimum doit être inférieur au prix maximum',
            'prix_max.numeric' => 'Le prix maximum doit être un nombre',

            'image.required' => 'L\'image est obligatoire',
        ];
    }

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $bar = Bar::create([
                'prix_min' => $this->prix_min,
                'prix_max' => $this->prix_max,
            ]);

            $annonce = new Annonce([
                'titre' => $this->nom,
                'type' => 'Bar',
                'description' => $this->description,
                'date_validite' => $this->date_validite,
                'entreprise_id' => $this->entreprise_id,
            ]);

            $bar->annonce()->save($annonce);

            $references = [
                ['Equipements vie nocturne', $this->equipements_vie_nocturne],
                ['Commodités de vie nocturne', $this->commodites_vie_nocturne],
            ];

            AnnoncesUtils::createManyReference($annonce, $references);

            AnnoncesUtils::createGalerie($annonce, $this->image, $this->galerie, 'bars');

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
        return redirect()->route('bars.create');
    }

    public function render()
    {
        return view('livewire.admin.bar.create');
    }
}
