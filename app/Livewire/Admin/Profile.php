<?php

namespace App\Livewire\Admin;

use App\Http\Controllers\AuthenticationController;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Profile extends Component
{
    public $user;
    public $editInfo = false;
    public $editPass = false;

    public $username;
    public $nom;
    public $prenom;
    public $email;
    public $password;
    public $password_confirmation;
    public $password_old;


    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('connexion');
        }

        $this->initialize();
    }

    public function initialize()
    {
        $this->user = User::find(auth()->user()->id);
        $this->username = $this->user->username;
        $this->nom = $this->user->nom;
        $this->prenom = $this->user->prenom;
        $this->email = $this->user->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->password_old = '';
    }

    // public function rules()
    // {
    //     return [
    //         'username' => 'required|min:3|max:255|unique:users,username,' . $this->user->id,
    //         'nom' => 'required|min:3|max:255',
    //         'prenom' => 'required|min:3|max:255',
    //         'email' => 'required|email|min:3|max:255|unique:users,email,' . $this->user->id,
    //         'password' => 'required|min:4|max:255|confirmed',
    //         'password_confirmation' => 'required|min:4|max:255',
    //     ];
    // }

    public function messages()
    {
        return [
            'username.required' => 'Le nom d\'utilisateur est obligatoire',
            'username.min' => 'Le nom d\'utilisateur doit contenir au moins 3 caractères',
            'username.max' => 'Le nom d\'utilisateur ne doit pas dépasser 255 caractères',
            'username.unique' => 'Le nom d\'utilisateur est déjà utilisé',
            'nom.required' => 'Le nom est obligatoire',
            'nom.min' => 'Le nom doit contenir au moins 3 caractères',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'prenom.required' => 'Le prénom est obligatoire',
            'prenom.min' => 'Le prénom doit contenir au moins 3 caractères',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères',
            'email.required' => 'L\'adresse email est obligatoire',
            'email.email' => 'L\'adresse email doit être valide',
            'email.min' => 'L\'adresse email doit contenir au moins 3 caractères',
            'email.max' => 'L\'adresse email ne doit pas dépasser 255 caractères',
            'email.unique' => 'L\'adresse email est déjà utilisée',
            'password.min' => 'Le mot de passe doit contenir au moins 4 caractères',
            'password.max' => 'Le mot de passe ne doit pas dépasser 255 caractères',
            'password_confirmation.required' => 'La confirmation du mot de passe est obligatoire',
            'password_old.required' => 'Le mot de passe actuel est obligatoire',
            'password_old.min' => 'Le mot de passe actuel doit contenir au moins 4 caractères',
            'password_old.max' => 'Le mot de passe actuel ne doit pas dépasser 255 caractères',
            'password_old.password' => 'Le mot de passe actuel est incorrect',
            'password.confirmed' => 'Les mots de passe ne correspondent pas',
        ];
    }

    public function editInformation()
    {
        $this->editInfo = true;
    }

    public function editPassword()
    {
        $this->editPass = true;
    }

    public function cancel()
    {
        $this->editInfo = false;
        $this->editPass = false;
        $this->initialize();
        $this->resetValidation();
    }

    public function update()
    {
        $validated = null;

        if ($this->editInfo) {
            $validated = $this->validate([
                'username' => 'required|min:3|max:255|unique:users,username,' . $this->user->id,
                'nom' => 'required|min:3|max:255',
                'prenom' => 'required|min:3|max:255',
                'email' => 'required|email|min:3|max:255|unique:users,email,' . $this->user->id,
            ]);
        } else {
            $validated = $this->validate([
                'password_old' => 'required|min:4|max:255',
                'password' => 'required|min:4|max:255|confirmed',
            ]);

            if (!Hash::check($this->password_old, $this->user->password)) {
                $validator = Validator::make([], []); // Empty data and rules

                // Add an error message to the password_old field
                $validator->errors()->add('password_old', 'Le mot de passe actuel est incorrect');

                $this->editPassword = true;

                // Throw a ValidationException with the validator instance
                throw new \Illuminate\Validation\ValidationException($validator);
            }
        }

        $this->user->update($validated);

        if ($this->editPass) {
            AuthenticationController::logout(request());
            // return redirect('/');
            return redirect()->route('login');
        }

        $this->cancel();

        // $this->dispatch('username:changed', [
        //     'username' => $this->user->nom . ' ' . $this->user->prenom
        // ]);

        // session()->flash('success', 'Votre compte a été mis à jour avec succès');
        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => __('Opération réussie'),
            'message' => __('Profil mis à jour avec succès'),
        ]);
        return;
    }

    public function render()
    {
        return view('livewire.admin.profile');
    }
}
