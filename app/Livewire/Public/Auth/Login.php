<?php

namespace App\Livewire\Public\Auth;

use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $error = false;
    public $message = '';
    public $email;
    public $password;
    public $remember = false;

    public function login()
    {
        $validated = $this->validate([
            'email' => 'required|min:4',
            'password' => 'required|min:4',
            'remember' => 'boolean',
        ], [
            'email.required' => 'Le champ email est obligatoire',
            'email.min' => 'Le champ email doit contenir au moins 4 caractères',
            'password.required' => 'Le champ mot de passe est obligatoire',
            'password.min' => 'Le champ mot de passe doit contenir au moins 4 caractères',
        ]);

        $request = new Request($validated);

        $login = AuthenticationController::loginService($request);
        if (!$login->status) {
            $this->error = true;
            $this->password = '';
            $this->message = $login->message;
            return;
        }

        // if (auth()->user()->hasRole('Administrateur')) {
        //     return redirect()->route('home');
        // }

        $this->dispatch('page:reload', []);
    }


    public function render()
    {
        return view('livewire.public.auth.login');
    }
}
