<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginValidateRequest;
use App\Http\Requests\registerValidationRequest;
use App\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }
    public function login(loginValidateRequest $req)
    {
        $data = $req->validated();
        if ($this->authService->login($data)) {
            return response()->json(['message' => 'Login successful'], 200);
        } else {
            return response()->json(['message' => 'Login successful'], 401);
        }
    }
    public function register(registerValidationRequest $req)
    {
        $data = $req->validated();
        $this->authService->register($data);
        return redirect(route("home"));
    }
}
