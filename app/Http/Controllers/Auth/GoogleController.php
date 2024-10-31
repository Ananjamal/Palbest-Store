<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Unable to login using Google. Please try again.');
        }

        // Find or create a user in the database
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Create a new user if not found
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(uniqid()), // Use a random password for Google login
            ]);
        }

        // Log the user in
        Auth::login($user, true);

        return redirect()->intended('/'); // Redirect to your intended route after login
    }
}
