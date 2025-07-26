<?php

namespace App\Livewire\Admin\Pays;

use Livewire\Component;
use App\Models\Pays;
use Illuminate\Support\Str;

class Create extends Component
{
    public $nom;
    public $code;
    public $indicatif;
    public $langue;

    protected $rules = [
        'nom' => ['required', 'string','min:3', 'max:255', 'unique:pays'],
        'code' => ['required', 'string','min:2', 'max:255', 'unique:pays'],
        'indicatif' => ['required', 'string','min:3', 'max:255', 'unique:pays'],
        'langue' => ['required', 'string', 'max:255'],
    ];

    protected $messages = [
        'nom.required' => 'Le nom du pays est obligatoire.',
        'nom.unique' => 'Le nom du pays existe déjà.',

        'code.required' => 'Le code du pays est obligatoire.',
        'code.unique' => 'Le code du pays existe déjà.',

        'indicatif.required' => 'L\'indicatif du pays est obligatoire.',
        'indicatif.unique' => 'L\'indicatif du pays existe déjà.',

        'langue.required' => 'La langue du pays est obligatoire.',
    ];

    public function store()
    {
        $validated = $this->validate();

        $validated['slug'] = Str::slug($validated['nom']);
        $validated['code'] = strtoupper($validated['code']);

        Pays::create($validated);

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title'   => __('Opération réussie'),
            'message' => __('Pays ajouté avec succès'),
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.pays.create');
    }
}
