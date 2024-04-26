<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, "login"])->name("login");
Route::post("/register", [AuthController::class, "register"])->name("register");
Route::get("/logout",[AuthController::class, "logout"])->name('logout');
Route::post("/test", [AuthController::class, "test"])->name("test");