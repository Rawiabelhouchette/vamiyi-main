<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    // Redirect to Google
    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            Log::info('Google OAuth response received', ['user' => $googleUser]);

            // Check if the user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Create a new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt('password'), // Generate a secure random password
                    'is_active' => true,
                    'username' => $googleUser->getNickname() ?? '',
                    'nom' => method_exists($googleUser, 'getLastName') ? $googleUser->getLastName() : '',
                    'prenom' => method_exists($googleUser, 'getFirstName') ? $googleUser->getFirstName() : '',
                    'telephone' => method_exists($googleUser, 'getPhoneNumber') ? $googleUser->getPhoneNumber() : '',
                ]);

                Log::info('New user created via Google OAuth', ['user_id' => $user->id, 'email' => $user->email]);
            }

            // Log in the user
            Auth::login($user);
            Log::info('User logged in via Google OAuth', ['user_id' => $user->id]);

            return redirect('/staff/dashboard'); // Redirect to dashboard
        } catch (\Exception $e) {
            Log::error('Google OAuth error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect('/')->with('error', 'Something went wrong! Please try again.');
        }

    }
}
