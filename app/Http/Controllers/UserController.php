<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('register');
    }  

    public function login(){
        return view('login');
    }

    public function dashboard(){
        return view('dashboard');
    }

}
