<?php

namespace App\Livewire\Admin\Ville;

use App\Models\Ville;
use Livewire\Component;
use App\Models\Pays;
use Illuminate\Support\Str;

class Create extends Component
{
    public $nom;
    public $pays_id;
    public $pays;

    public function rules() {
        return [
            'nom' => 'required|string|min:3|unique:villes,nom,id,pays_id',
            'pays_id' => 'required|integer|exists:pays,id',
        ];
    }

    protected $messages = [
        'nom.required' => 'Le nom de la ville est obligatoire.',
        'nom.unique' => 'Le nom de la ville existe déjà.',

        'pays_id.required' => 'Le pays de la ville est obligatoire.',
        'pays_id.exists' => 'Le pays de la ville n\'existe pas.',
    ];

    public function mount()
    {
        $this->pays = Pays::all();
    }

    public function store()
    {
        $validated = $this->validate();
        $validated['slug'] = Str::slug($validated['nom']);

        Ville::create($validated);

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title'   => __('Opération réussie'),
            'message' => __('Ville ajoutée avec succès'),
        ]);        

        $this->reset();

        $this->pays = Pays::all();
    }

    public function render()
    {
        return view('livewire.admin.ville.create');
    }
}
