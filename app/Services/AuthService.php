<?php

namespace App\Services;

use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDO;

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
        if (Auth::attempt(["email" => $data['email'], "password" => $data['password']])) {
            $user = Auth::user();
            return response()->json(['message' => 'Авторизация прошла', "data" => $data, "user" => $user], 200);
        }
        return response()->json(['message' => 'Неверные данные', "data" => $data], 401);
    }
    public function logout()
    {
        Auth::logout();
    }
    public function register($data)
    {

        User::create($data);
    }
}
