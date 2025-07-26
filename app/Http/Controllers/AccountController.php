<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\CustomSession;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Jobs\SendPasswordResetEmail;

class AccountController extends Controller
{
    public function index()
    {
        CustomSession::reset();

        if (!auth()->check()) {
            return redirect()->route('connexion');
        }
        return view('admin.profile');
    }

    public function indexFavoris()
    {
        CustomSession::reset();

        if (!auth()->check()) {
            return redirect()->route('connexion');
        }

        // return view('public.user.favoris');
        return view('admin.favoris');
    }

    public function indexComment()
    {
        CustomSession::reset();

        return view('admin.comment');
    }

    public function contact()
    {
        CustomSession::reset();

        return view('public.contact');
    }

    public function resetPassword(Request $request)
    {
        // YOU SHOULD NOT TELL TO THE USER IF THE EMAIL EXISTS OR NOT
$request->validate([
            'email' => 'required|email',
        ], [
            'email' => 'Veuillez saisir une adresse email valide.',
        ]);

        // check if the email exists
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('notification.rest-password.success');
        }

        // Create a new token to be used for the password reset link
        $token = Password::createToken($user);

        // Create the password reset link
        $resetLink = url(config('app.url') . route('password.reset', ['token' => $token, 'email' => $request->email], false));

        // Envoyer l'email de réinitialisation
        // Mail::send(new \App\Mail\PasswordReset($user, $resetLink));
        SendPasswordResetEmail::dispatch($user, $resetLink);

        return redirect()->route('notification.rest-password.success');
    }

    public function notificationSuccess()
    {
        if (auth()->check()) {
            return redirect('/');
        }

        return view('public.notifications.reset-email-success');
    }

    public function newPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required',
        ], [
            'token.exists' => 'Le token est invalide.',
            'email.exists' => 'Cette adresse email n\'existe pas.',
            'password.min' => 'Le mot de passe doit contenir au moins 4 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            AuthenticationController::login($request);
            return redirect('/');
        } else {
            return back()->withErrors(['email' => 'Le lien de réinitialisation a expiré.']);
        }
    }

    public function editPassword()
    {
        return view('new-password');
    }

    public function contactUs(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'email' => 'required|email',
            'objet' => 'required|string',
            'message' => 'required|string'
        ]);

        return back()->with('success', 'Votre message a été envoyé avec succès');
    }
}
