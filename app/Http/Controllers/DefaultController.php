<?php

namespace App\Http\Controllers;

class DefaultController extends Controller
{
    public function index(){
        return view("main");
    }
}
