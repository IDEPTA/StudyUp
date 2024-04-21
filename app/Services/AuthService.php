<?php

namespace App\Services;

use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function login($data)
    {
        Auth::attempt($data);
    }
    public function logout()
    {
    }
    public function register($data)
    {
        User::create($data);
    }
}
