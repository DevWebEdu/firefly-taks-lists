<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showLogin()
    {
        return Inertia::render('auth/Login');
    }

    public function showRegister()
    {
        return Inertia::render('auth/Register');
    }
}
