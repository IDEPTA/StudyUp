<?php

namespace App\Http\Controllers;

use App\Http\Requests\editProfileValidation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit(editProfileValidation $req, $id)
    {
        if ($req->validated()) {
            $data = $req->validated();
            $user = User::find($id);
            if (Hash::check($data['password'], $user->password)) {
                $user->update($data);
                return response()->json(['message' => 'Валидация прошла успешно', "user" => $user], 200);
            }
            return response()->json(['message' => 'Валидация прошла НЕ успешно']);
        }
    }
}
