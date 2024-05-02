<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\variantsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, "login"])->name("login");
Route::post("/register", [AuthController::class, "register"])->name("register");
Route::get("/logout", [AuthController::class, "logout"])->name('logout');
Route::get("/checkAuth", [AuthController::class, "checkAuth"])->name("checkAuth");
Route::resource("variants", variantsController::class);
Route::post("/examination",[TreatmentController::class,"examination"])->name("examination");