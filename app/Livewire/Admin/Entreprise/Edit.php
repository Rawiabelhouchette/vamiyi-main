<?php

namespace App\Livewire\Admin\Entreprise;

use App\Models\Entreprise;
use App\Models\Pays;
use App\Models\Quartier;
use App\Models\Ville;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $nom = '';
    public $description = '';
    public $site_web = '';
    public $email = '';
    public $telephone = '';
    public $instagram = '';
    public $facebook = '';
    public $whatsapp = '';
    public $logo = '';
    public $longitude = '';
    public $latitude = '';

    public $pays_id = '';
    public $ville_id = '';
    public $quartier_id = '';

    public $nbr_planning = 1;

    public $pays;
    public $villes = [];
    public $quartiers = [];
    public $autreJour = true;
    public $entreprise;

    public $plannings = [
        [
            'jour' => '',
            'heure_debut' => '',
            'heure_fin' => '',
        ],
    ];

    public function mount($entreprise)
    {
        $this->entreprise = $entreprise;
        $this->pays = Pays::all();
        $this->villes = $entreprise->quartier ? Ville::where('pays_id', $entreprise->quartier->ville->pays_id)->get() : [];
        $this->quartiers = $entreprise->quartier ? Quartier::where('ville_id', $entreprise->quartier->ville_id)->get() : [];
        $this->nom = $entreprise->nom;
        $this->description = $entreprise->description;
        $this->site_web = $entreprise->site_web;
        $this->email = $entreprise->email;
        $this->telephone = $entreprise->telephone;
        $this->instagram = $entreprise->instagram;
        $this->facebook = $entreprise->facebook;
        $this->whatsapp = $entreprise->whatsapp;
        $this->logo = $entreprise->logo;
        $this->longitude = $entreprise->longitude;
        $this->latitude = $entreprise->latitude;
        $this->pays_id = $entreprise->quartier ? $entreprise->quartier->ville->pays_id : '';
        $this->ville_id = $entreprise->quartier ? $entreprise->quartier->ville_id : '';
        $this->quartier_id = $entreprise->quartier ? $entreprise->quartier_id : '';
        if (!empty($entreprise->heure_ouverture->toArray())) {
            $this->plannings = $entreprise->heure_ouverture->toArray();
        }
        $this->nbr_planning = count($this->plannings);

        $this->dispatch('showLocation', [
            'lon' => $this->longitude,
            'lat' => $this->latitude,
        ]);
    }

    // rules
    public function rules()
    {
        return [
            'nom' => 'required|string|min:3|unique:entreprises,nom,' . $this->entreprise->id . ',id,quartier_id,' . $this->quartier_id,
            'description' => 'nullable|string|min:3',
            'site_web' => 'nullable|string|min:3',
            'email' => 'required|string|min:3',
            'telephone' => 'nullable|string|min:3',
            'instagram' => 'nullable|string|min:3',
            'facebook' => 'nullable|string|min:3',
            'whatsapp' => 'required|string|min:3',
            'logo' => 'nullable|string|min:3',
            'quartier_id' => 'required|integer|exists:quartiers,id',
            'longitude' => 'nullable|string|min:3',
            'latitude' => 'nullable|string|min:3',
        ];
    }

    public function updatedPaysId($pays_id)
    {
        $this->ville_id = '';
        $this->quartier_id = '';
        $this->villes = Ville::where('pays_id', $pays_id)->get();
    }

    public function updatedVilleId($ville_id)
    {
        $this->quartier_id = '';
        $this->quartiers = Quartier::where('ville_id', $ville_id)->get();
    }

    #[On('changerJour')]
    public function changerJour($valeur)
    {
        $this->autreJour = $valeur;
    }

    public function addPlanning()
    {
        if (!$this->autreJour)
            return;

        if ($this->nbr_planning <= 7) {
            $this->nbr_planning++;
            if ($this->nbr_planning > 1) {
                $this->tousLesJours = false;
            }
            $this->plannings[] = [
                'jour' => '',
                'heure_debut' => '',
                'heure_fin' => '',
            ];
        }
    }

    public function removePlanning($key)
    {
        unset($this->plannings[$key]);
        $this->nbr_planning--;
        if ($this->nbr_planning == 1) {
            $this->tousLesJours = true;
        }
    }

    #[On('setLocation')]
    public function setLocation($location)
    {
        $this->longitude = (string) $location['lon'];
        $this->latitude = (string) $location['lat'];
    }

    public function update()
    {
        $validated = $this->validate();

        // check if date is not repeated
        $jours = [];
        $jour_tmp = '';
        foreach ($this->plannings as $planning) {
            if (in_array($planning['jour'], $jours)) {
                $index = array_search($planning, $this->plannings) + 1;
                $jour_tmp = $planning['jour'];
                $this->dispatch('alert:modal', [
                    'message' => __('Jour [' . $jour_tmp . '] est déjà sélectionné'),
                ]);
                return;
            }
            $jours[] = $planning['jour'];
        }

        // Verifier si l'heure de debut est inferieur à l'heure de fin
        foreach ($this->plannings as $planning) {
            if ($planning['heure_debut'] > $planning['heure_fin']) {
                $index = array_search($planning, $this->plannings) + 1;
                $this->dispatch('alert:modal', [
                    'message' => __('Heure de fermeture [' . $index . '] doit être supérieur à heure de d\'ouverture'),
                ]);
                return;
            }
        }

        try {
            DB::beginTransaction();
            $this->entreprise->update($validated);
            $this->entreprise->heure_ouverture()->delete();
            $this->entreprise->heure_ouverture()->createMany($this->plannings);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Opération réussie'),
                'message' => __('Une erreur est survenue lors de l\'ajout de l\'entreprise'),
            ]);
            return;
        }

        session()->flash('success', 'Entreprise modifiée avec succès.');

        return redirect()->route('entreprises.index');
    }


    public function render()
    {
        return view('livewire.admin.entreprise.edit');
    }
}
