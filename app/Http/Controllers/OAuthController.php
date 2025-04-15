<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $socialUser = Socialite::driver('google')
            ->stateless() // Ensures OAuth works without session issues
            ->with(['verify' => 'C:\wamp64\bin\php\php8.2.13\cacert.pem'])
            ->user();

        // Check if the user exists
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => bcrypt(str()->random(12)),
                'provider' => 'google',
                'provider_id' => $socialUser->getId(),
            ]);
        }

        Auth::login($user);

        return redirect('/');
    }
}
