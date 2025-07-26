<?php

namespace App\Livewire\Admin\Ville;

use App\Models\Pays;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Ville;

class Edit extends Component
{
    public $pays;
    public $nom;
    public $pays_id;
    public $ville;

    public function mount($ville)
    {
        $this->ville = $ville;
        $this->nom = $ville->nom;
        $this->pays_id = $ville->pays_id;
        $this->pays = Pays::all();
    }

    protected function rules()
    {
        return [
            'nom' => 'required|string|min:3|unique:villes,nom,NULL,id,pays_id,' . $this->pays_id,
            'pays_id' => 'required|integer|exists:pays,id',
        ];
    }


    protected $messages = [
        'nom.required' => 'Le nom de la ville est obligatoire.',
        'nom.unique' => 'Le nom de la ville existe déjà.',

        'pays_id.required' => 'Le pays de la ville est obligatoire.',
        'pays_id.exists' => 'Le pays de la ville n\'existe pas.',
    ];

    public function udpate() {
        $validated = $this->validate();
        $validated['slug'] = Str::slug($validated['nom']);

        $this->ville->update($validated);

        session()->flash('success','Ville modifiée avec succès');
        return redirect()->route('villes.index');
    }

    public function render()
    {
        return view('livewire.admin.ville.edit');
    }
}
