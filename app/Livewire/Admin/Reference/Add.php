<?php

namespace App\Livewire\Admin\Reference;

use App\Models\Reference;
use App\Models\ReferenceValeur;
use App\Utils\References;
use Livewire\Component;

class Add extends Component
{
    public $id = null;
    public $type ='';
    public $nom ='';
    public $valeur ='';

    public $libelle = 'Créer une référence';
    public $buttonLibelle = 'Enregistrer';
    public $formIcon = 'save';

    public $isEdit = false;

    public $typeList = [];
    public $nomList = [];

    public function mount() {
        $this->typeList = References::getList();
    }

    protected $listeners = [
        'editReference' => 'editReference',
    ];

    public function updatedType($value)
    {
        $this->nom = '';
        $this->nomList = Reference::where('type', $value)->pluck('nom')->toArray();
    }

    public function editReference(ReferenceValeur $ref)
    {
        $this->libelle = 'Modifier une référence';
        $this->buttonLibelle = 'Modifier';

        $this->id = $ref->id;
        $this->type = $ref->reference->type;
        
        $this->nomList = Reference::where('type', $ref->reference->type)->pluck('nom')->toArray();
        
        $this->nom = $ref->reference->nom;

        $this->valeur = $ref->valeur;

        $this->isEdit = true;

        $this->formIcon = 'edit';
    }

    protected $rules = [
        'type' => 'required',
        'nom' => 'required',
        'valeur' => 'required',
    ];

    public function store() {
        $this->validate();

        $reference = Reference::where('type', $this->type)->where('nom', $this->nom)->first();
        if (!$reference) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title'   => __('Opération échouée'),
                'message' => __('Cette combinaison type/nom n\'existe pas.'),
            ]);
        }
        
        $referenceValeur = ReferenceValeur::where('valeur', $this->valeur)->where('reference_id', $reference->id)->first();
        if ($referenceValeur) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title'   => __('Opération échouée'),
                'message' => __('Cette référence existe déjà.'),
            ]);
            return;
        }
        
        if($this->isEdit) {
            $ref = ReferenceValeur::find($this->id);
            $validated = [
                'reference_id' => $reference->id,
                'valeur' => $this->valeur,
            ];
            $this->update($ref, $validated);
            return;
        }

        ReferenceValeur::create([
            'reference_id' => $reference->id,
            'valeur' => $this->valeur,
        ]);
        
        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title'   => __('Opération réussie'),
            'message' => __('Référence ajoutée avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->reset();

        $this->typeList = References::getList();

    }

    public function update(ReferenceValeur $ref, $validated) {
        $ref->update($validated);
        
        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title'   => __('Opération réussie'),
            'message' => __('Référence modifiée avec succès'),
        ]);

        $this->dispatch('relaod:dataTable');

        $this->reset();
    }

    public function resetForm()
    {
        $this->reset();
        $this->isEdit = false;
        $this->typeList = References::getList();

    }

    public function render()
    {
        return view('livewire.admin.reference.add');
    }
}
