<?php

namespace App\Livewire\Admin\Quartier;

use App\Models\Quartier;
use App\Models\Ville;
use Livewire\Component;
use App\Models\Pays;
use Illuminate\Support\Str;

class Create extends Component
{
    public $nom;
    public $ville_id = '';
    public $pays_id = '';
    public $pays;
    public $villes = [];

    public function mount()
    {
        $this->pays = Pays::all();
    }

    public function rules() {
        return [
            'nom' => 'required|string|min:3|unique:quartiers,nom,id,ville_id',
            'ville_id' => 'required|integer|exists:villes,id',
        ];
    }

    protected $messages = [
        'nom.required' => 'Le nom de la ville est obligatoire.',
        'nom.unique' => 'Le nom de la ville existe déjà.',

        'ville_id.required' => 'Le pays de la ville est obligatoire.',
        'ville_id.exists' => 'Le pays de la ville n\'existe pas.',
    ];

    public function updatedPaysId($pays_id)
    {
        $this->ville_id = '';
        $this->villes = Ville::where('pays_id', $pays_id)->get();
    }

    public function store()
    {
        $validated = $this->validate();
        $validated['slug'] = Str::slug($validated['nom']);

        Quartier::create($validated);

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title'   => __('Opération réussie'),
            'message' => __('Quartier ajouté avec succès'),
        ]);

        $this->reset();

        $this->pays = Pays::all();
        $this->villes = [];
    }

    public function render()
    {
        return view('livewire.admin.quartier.create');
    }
}
