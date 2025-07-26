<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticationController extends Controller
{
    public static function loginService(Request $request): object
    {
        $remember = $request->has('remember');
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $request->merge([
                'email' => $request->email
            ]);
            $credentials = $request->only('email', 'password');
        } else {
            $request->merge([
                'username' => $request->email
            ]);
            $credentials = $request->only('username', 'password');
        }

        if (!Auth::attempt($credentials, $remember)) {
            return (object) [
                'status' => false,
                'message' => 'Identifiant ou mot de passe incorrect.'
            ];
        }

        if (auth()->user()->is_active == 0) {
            AuthenticationController::logout($request);
            return (object) [
                'status' => false,
                'message' => 'Votre compte est désactivé. Veuillez contacter l\'administrateur.'
            ];
        }

        // if ($request->filled('url')) {
        //     return redirect($request->url);
        // } elseif ($request->session()->has('url.intended.url')) {
        //     return redirect($request->session()->get('url.intended.url'));
        // }

        // $request->session()->regenerate();

        if (auth()->user()->hasRole('Administateur')) {
            Log::channel('login')->info('Connexion de l\'utilisateur : (' . auth()->user()->id . ') ' . auth()->user()->username);
        }

        return (object) [
            'status' => true,
            'message' => 'Connexion réussie.'
        ];
    }

    public static function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $login = AuthenticationController::loginService($request);

        if (!$login->status) {
            return back()->withErrors([
                'email' => $login->message,
            ]);
        }
        return back();
    }

    public static function logoutService(Request $request): object
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return (object) [
            'status' => true,
            'message' => 'Déconnexion réussie.'
        ];
    }

    public static function logout(Request $request)
    {
        $logout = AuthenticationController::logoutService($request);

        if (!$logout->status) {
            return back()->withErrors([
                'email' => $logout->message,
            ]);
        }

        return redirect('/');
    }

    public static function reset(Request $request)
    {
        // dd($request->all());
        if ($request->has('token') && $request->has('email')) {
            return view('new-password', [
                'token' => $request->token,
                'email' => $request->email,
            ]);
        }

        if (auth()->check()) {
            return redirect('/');
        }

        return view('reset-password');
    }

    public static function resetPassword(Request $request)
    {
        // $request->validate([
        //     'token' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required|confirmed|min:8',
        // ]);

        // $status = Password::reset(
        //     $request->only('email', 'password', 'password_confirmation', 'token'),
        //     function ($user, $password) {
        //         $user->forceFill([
        //             'password' => Hash::make($password)
        //         ])->setRememberToken(Str::random(60));

        //         $user->save();

        //         event(new PasswordReset($user));
        //     }
        // );

        // if ($status == Password::PASSWORD_RESET) {
        //     return redirect()->route('login')->with('status', __($status));
        // } else {
        //     return back()->withErrors(['email' => [__($status)]]);
        // }
    }
}
