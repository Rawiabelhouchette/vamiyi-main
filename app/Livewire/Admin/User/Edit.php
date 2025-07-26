<?php

namespace App\Livewire\Admin\User;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $userId;
    public $nom;
    public $prenom;
    public $email;
    public $username;
    public $telephone;
    public $is_active;
    public $role = '';
    public $entreprise_id;
    public $isProfessionnel = false;


    public $roles = [];
    public $entreprises = [];

        
    public function mount($userId)
    {
        $this->entreprises = Entreprise::orderBy('nom', 'asc')->select('nom', 'id')->get();
        $this->roles = Role::orderBy('name', 'asc')->select('name', 'id')->get();
        $this->userId = $userId;
        $user = User::findOrFail($userId);
        $this->nom = $user->nom;
        $this->prenom = $user->prenom;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->telephone = $user->telephone;
        $this->is_active = $user->is_active;
        $this->role = $user->roles->first()->name;
        // TODO : Must change something here
        // $this->entreprise_id = $user->entreprise_id;
        if ($this->entreprise_id) {
            $this->isProfessionnel = true;
        }
    }

    public function rules() {
        $rules =  [
            'nom' => 'required|string|min:3',
            'prenom' => 'nullable|string|min:3',
            'email' => 'nullable|email|unique:users,email,' . $this->userId,
            'username' => 'required|string|min:3|unique:users,username,' . $this->userId,
            'telephone' => 'nullable|string|min:3|unique:users,telephone,' . $this->userId,
            'is_active' => 'required|boolean',
            'role' => 'required|string|exists:roles,name',
        ];

        if ($this->isProfessionnel) {
            $rules['entreprise_id'] = 'required|integer|exists:entreprises,id';
        }

        return $rules;
    }

    protected $messages = [
        'username.unique' => 'Identifiant déjà pris.',
        'email.unique' => 'Adresse email déjà prise.',
        'telephone.unique' => 'Numéro de téléphone déjà pris.',
        'entreprise_id.required' => 'Le champ entreprise est obligatoire.',
    ];

    public function updatedRole($value)
    {
        // $this->roles = Role::orderBy('name', 'asc')->select('name', 'id')->get();
        if ($value == 'Professionnel') {
            $this->entreprise_id = null;
            $this->isProfessionnel = true;
        } else {
            $this->isProfessionnel = false;
        }
    }

    public function update()
    {
        $validated = $this->validate();
        if (!$this->isProfessionnel) {
            $validated['entreprise_id'] = null;
        }
        DB::beginTransaction();

        try {
            // dd($validated);
            $user = User::findOrFail($this->userId);
            $user->update($validated);
            $user->syncRoles($this->role);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title'   => __('Une erreur s\'est produite'),
                'message' => __('Utilisateur ajouté avec succès'),
            ]);
        }

        session()->flash('success', 'Utilisateur modifié avec succès.');

        return redirect()->route('users.index');
        

        // $this->dispatch('swal:modal', [
        //     'icon' => 'success',
        //     'title'   => __('Opération réussie'),
        //     'message' => __('Utilisateur ajouté avec succès'),
        // ]);        

        // $this->reset();
        

        // $this->roles = Role::orderBy('id', 'desc')->select('name', 'id')->get();
    }

    public function render()
    {
        return view('livewire.admin.user.edit');
    }
}

