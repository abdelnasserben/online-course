<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {

        //dd($request->validated());
        User::create($request->validated());

        return redirect()->route('login')->with('success', 'Compte enregistré avec succès.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {

        if (Auth::attempt($request->validated())) {
            return redirect()->intended('dashboard')->with('success', 'Heureux de vous revoir ' . Auth::user()->name . ' !');
        }

        return back()->withErrors([
            'email' => 'Identifiants invalides',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Vous avez bien été déconnecté.');
    }
}
