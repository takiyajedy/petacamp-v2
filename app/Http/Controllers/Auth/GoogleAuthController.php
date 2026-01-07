<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google callback
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user exists with this Google ID
            $user = User::where('google_id', $googleUser->id)->first();
            
            if ($user) {
                // User exists, just login
                Auth::login($user);
                return redirect()->intended('/camps')->with('success', 'Welcome back, ' . $user->name . '!');
            }
            
            // Check if email exists
            $existingUser = User::where('email', $googleUser->email)->first();
            
            if ($existingUser) {
                // Link Google account to existing user
                $existingUser->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                ]);
                
                Auth::login($existingUser);
                return redirect()->intended('/camps')->with('success', 'Google account linked successfully!');
            }
            
            // Create new user
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => Hash::make(Str::random(24)), // Random password
                'email_verified_at' => now(), // Auto verify email
            ]);
            
            Auth::login($newUser);
            
            return redirect()->intended('/camps')->with('success', 'Account created successfully! Welcome to PetaCamp!');
            
        } catch (\Exception $e) {
            return redirect()->route('camps.index')->with('error', 'Failed to login with Google. Please try again.');
        }
    }
}