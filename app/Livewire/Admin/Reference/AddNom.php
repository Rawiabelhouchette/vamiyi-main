<?php

namespace App\Livewire\Admin\Reference;

use App\Models\Reference;
use App\Utils\References;
use Livewire\Component;

class AddNom extends Component
{
    public $id = null;
    public $type ='';
    public $nom ='';

    public $libelle = 'Créer un nouveau nom de référence';
    public $buttonLibelle = 'Enregistrer';
    public $formIcon = 'save';

    public $isEdit = false;

    public $typeList = [];

    public function mount() {
        $this->typeList = Reference::select('type')->distinct()->get()->pluck('type')->toArray();
    }

    protected $listeners = [
        'editNomReference' => 'editNomReference',
    ];

    public function editNomReference(Reference $ref)
    {

        $this->libelle = 'Modifier le nom de référence';
        $this->buttonLibelle = 'Modifier';

        $this->typeList = Reference::select('type')->distinct()->get()->pluck('type')->toArray();
        
        $this->id = $ref->id;
        $this->type = $ref->type;
        $this->nom = $ref->nom;

        $this->isEdit = true;

        $this->formIcon = 'edit';

    }

    protected $rules = [
        'type' => 'required',
        'nom' => 'required',
    ];

    public function store() {
        $validated = $this->validate();

        $isUnique = Reference::where('type', $this->type)->where('nom', $this->nom)->first();

        if($isUnique) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title'   => __('Opération échouée'),
                'message' => __('Nom de référence existe déjà'),
            ]);
            return;
        }

        if($this->isEdit) {
            $ref = Reference::find($this->id);
            $this->update($ref, $validated);
            return;
        }

        Reference::create($validated);
        
        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title'   => __('Opération réussie'),
            'message' => __('Nom de référence ajouté avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->reset();
    }

    public function update(Reference $ref, $validated) {
        $ref->update($validated);
        
        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title'   => __('Opération réussie'),
            'message' => __('Nom de référence modifié avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->reset();
    }

    public function resetForm()
    {
        $this->reset();
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.admin.reference.add-nom');
    }
}
