<?php

namespace App\Livewire\Admin\Quartier;

use App\Models\Quartier;
use App\Models\Ville;
use Livewire\Component;
use App\Models\Pays;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $nom;
    public $quartier;
    public $ville_id = '';
    public $pays_id = '';
    public $pays;
    public $villes = [];

    public function mount($quartier)
    {
        $this->nom = $quartier->nom;
        $this->ville_id = $quartier->ville_id;
        $this->pays_id = $quartier->ville->pays_id;
        $this->pays = Pays::all();
        $this->villes = Ville::where('pays_id', $this->pays_id)->get();
    }

    public function rules() {
        return [
            'nom' => 'required|string|min:3|unique:quartiers,nom,NULL,id,ville_id,' . $this->ville_id,
            'ville_id' => 'required|integer|exists:quartiers,id',
        ];
    }

    protected $messages = [
        'nom.required' => 'Le nom du quartier est obligatoire.',
        'nom.unique' => 'Le nom du quartier existe déjà.',

        'ville_id.required' => 'Le pays de la ville est obligatoire.',
        'ville_id.exists' => 'Le pays de la ville n\'existe pas.',
    ];

    public function updatedPaysId($pays_id)
    {
        $this->ville_id = '';
        $this->villes = Ville::where('pays_id', $pays_id)->get();
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['slug'] = Str::slug($validated['nom']);

        $this->quartier->update($validated);

        session()->flash('success','Quartier modifié avec succès !');

        redirect()->route('quartiers.index');
    }

    public function render()
    {
        return view('livewire.admin.quartier.edit');
    }
}
