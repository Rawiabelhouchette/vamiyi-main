<?php

namespace App\Livewire\Public\Auth;

use App\Http\Controllers\AuthenticationController;
use App\Mail\RegisterConfirmation;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class Register extends Component
{
    public $error = false;
    public $message = '';

    public $type = 'Usager';
    public $nom;
    public $prenom;
    public $sexe;
    public $telephone;
    public $email;
    public $username;
    public $password;
    public $password_confirmation;
    public $remember = false;

    public function rules()
    {
        return [
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'type' => 'required|in:Usager,Professionnel',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'remember' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'prenom.required' => 'Le prenom est obligatoire',
            'sexe.required' => 'Le sexe est obligatoire',
            'username.required' => 'Le nom d\'utilisateur est obligatoire',
            'username.unique' => 'Ce nom d\'utilisateur existe deja',
            'type.required' => 'Le type d\'utilisateur est obligatoire',
            'type.in' => 'Le type d\'utilisateur est invalide',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'L\'email est invalide',
            'email.unique' => 'Cet email existe deja',
            'password.required' => 'Le mot de passe est obligatoire',
            'password_confirmation.required' => 'La confirmation du mot de passe est obligatoire',
            'password_confirmation.same' => 'Les mots de passe ne sont pas identiques',
        ];
    }

    public function register()
    {
        $this->validate();

        // TODO : check if email is valid 

        DB::beginTransaction();

        try {
            $user = User::create([
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'email' => $this->email,
                'username' => $this->username,
                'password' => $this->password,
            ]);

            $user->assignRole($this->type);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->error = true;
            $this->message = 'Erreur lors de l\'enregistrement';
            return;
        }

        Mail::to($this->email)
            ->send(new RegisterConfirmation($user));


        $request = new Request([
            'email' => $this->username,
            'password' => $this->password,
            'remember' => $this->remember,
        ]);

        // try {
        //     Mail::send('public.email-welcome', ['prenom' => $this->prenom], function ($message) {
        //         $message->to($this->email)
        //             ->subject('Bienvenue sur la plateforme de publication des annonces');
        //     });
        // } catch (\Exception $e) {
        //     Log::error('Erreur lors de l\'envoi du mail de bienvenue : ' . $e->getMessage());
        // }

        $login = AuthenticationController::loginService($request);
        if (!$login->status) {
            $this->error = true;
            $this->message = $login->message;
            $this->password = '';
            return;
        }

        $this->dispatch('page:reload', []);
    }

    public function render()
    {
        return view('livewire.public.auth.register');
    }
}
