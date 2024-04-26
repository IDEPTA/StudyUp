<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\loginValidateRequest;
use App\Http\Requests\registerValidationRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }
    public function login(loginValidateRequest $req)
    {
        if($req->validated()){
            $data = $req->validated();
            $this->authService->login($data);
            $user = Auth::user();
            return response()->json(['message' => 'Все заебись', "data" => $data, "user"=>$user], 200);
        }
    }
    public function register(registerValidationRequest $req)
    {
        if($req->validated()){
            $data = $req->validated();
            $this->authService->register($data);
            return response()->json(['message' => 'Все заебись', "data" => $data], 200);
        }
    }
    public function logout(){
        $this->authService->logout();
        return response()->json(['message' => 'Вы разлогинились'], 200);
    }
    public function test()
    {
        return response()->json(['message' => 'Все не заебись'], 401);
    }
}
