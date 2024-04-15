<?php

namespace App\Interfaces;

interface AuthServiceInterface
{
    public function login($logindata);
    public function logout();
    public function register($registerdata);
}
