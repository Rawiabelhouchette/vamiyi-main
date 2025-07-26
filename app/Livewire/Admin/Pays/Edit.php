<?php

namespace App\Livewire\Admin\Pays;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Pays;

class Edit extends Component
{
    public $pays;
    public $nom;
    public $code;
    public $indicatif;
    public $langue;


    public function rules() {
        return [
            'nom' => 'required|string|min:3|unique:pays,nom,' . $this->pays->id,
            'code' => 'required|string|unique:pays,code,' . $this->pays->id,
            'indicatif' => 'required|string|min:3|unique:pays,indicatif,' . $this->pays->id,
            'langue' => 'required|string|min:3',
        ];
    }





    protected $rules = [
        'nom' => ['required', 'string', 'max:255', 'unique:pays'],
        'code' => ['required', 'string', 'max:255', 'unique:pays'],
        'indicatif' => ['required', 'string', 'max:255', 'unique:pays'],
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

    public function mount($pays)
    {
        $this->nom = $pays->nom;
        $this->code = $pays->code;
        $this->indicatif = $pays->indicatif;
        $this->langue = $pays->langue;
    }

    public function update()
    {
        $validated = $this->validate();

        $validated['slug'] = Str::slug($validated['nom']);
        $validated['code'] = strtoupper($validated['code']);

        $this->pays->update($validated);

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title'   => __('Opération réussie'),
            'message' => __('Pays modifié avec succès'),
        ]);

        return redirect()->route('pays.index');
    }


    public function render()
    {
        return view('livewire.admin.pays.edit');
    }
}
