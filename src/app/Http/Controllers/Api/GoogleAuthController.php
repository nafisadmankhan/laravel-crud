<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{
    // 1. Redirects the frontend to Google
    public function redirect()
    {
        return response()->json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl()
        ]);
    }

    // 2. Handles the callback from Google
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::updateOrCreate([
                'email' => $googleUser->email,
            ], [
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return redirect()->away(env('FRONTEND_URL', 'http://localhost:3000') . '/login/success?token=' . $token);

        } catch (\Exception $e) {
            return redirect()->away(env('FRONTEND_URL', 'http://localhost:3000') . '/login?error=GoogleAuthFailed');
        }
    }
}
