<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data)
    {   
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'otp' => rand(100000, 999999),
            'otp_expires_at' => now()->addMinutes(10),
        ]);;
    }

    public function registerAdmin(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'otp' => rand(100000, 999999),
            'otp_expires_at' => now()->addMinutes(10),
            'is_admin' => true,
        ]);
    }

    public function login(array $credentials)
    {
        // Determine field type (email, username, or mobile)
        $fieldType = filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (is_numeric($credentials['identifier'])) {
            $fieldType = 'mobile';
        }

        // Prepare credentials array
        $attemptCredentials = [
            $fieldType => $credentials['identifier'],
            'password' => $credentials['password']
        ];

        // Attempt login
        if (Auth::attempt($attemptCredentials)) {
            $user = Auth::user();
        if(!$user->email_verified_at)
        {
            return 'Notverified';
        }

        $token = $user->createToken('authToken')->accessToken;

            return [
                'user' => $user,
                'token' => $token,
            ];
        }
        return null; // Return null if login fails
    }
}
