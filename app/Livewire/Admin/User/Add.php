<?php

namespace App\Livewire\Admin\User;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Add extends Component
{
    public $nom;
    public $prenom;
    public $email;
    public $username;
    public $telephone;
    public $is_active;
    public $password;
    public $password_confirmation;
    public $role = '';
    public $entreprise_id;
    public $isProfessionnel = false;

    public $roles = [];
    public $entreprises = [];

    public function mount()
    {
        $this->roles = Role::orderBy('name', 'asc')->select('name', 'id')->get();
        $this->entreprises = Entreprise::orderBy('nom', 'asc')->select('nom', 'id')->get();
    }

    public function rules()
    {
        // dd($this->entreprise_id);    
       $rules = [
            'nom' => 'required|string|min:3',
            'prenom' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|min:3|unique:users,username',
            'telephone' => 'required|string|min:3|unique:users,telephone',
            'is_active' => 'required|boolean',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required|string|min:3',
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
        'password.confirmed' => 'Les mots de passe ne correspondent pas.',
    ];

    public function updatedRole($value)
    {
        $this->roles = Role::orderBy('name', 'asc')->select('name', 'id')->get();
        if ($value == 'Professionnel') {
            $this->entreprise_id = null;
            $this->isProfessionnel = true;
        } else {
            $this->isProfessionnel = false;
        }
    }

    public function updatedEntrepriseId($value)
    {
        $this->entreprise_id = $value;
        $this->entreprises = Entreprise::orderBy('nom', 'asc')->select('nom', 'id')->get();
        $this->roles = Role::orderBy('name', 'asc')->select('name', 'id')->get();
    }

    public function store()
    {
        $validated = $this->validate();
        
        DB::beginTransaction();

        try {
            $user = User::create($validated);
            $user->assignRole($this->role);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title'   => __('Une erreur s\'est produite'),
                'message' => __('Utilisateur ajouté avec succès'),
            ]);   
        }

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title'   => __('Opération réussie'),
            'message' => __('Utilisateur ajouté avec succès'),
        ]);        

        $this->reset();
        

        $this->roles = Role::orderBy('name', 'asc')->select('name', 'id')->get();
    }

    public function render()
    {
        return view('livewire.admin.user.add');
    }
}
