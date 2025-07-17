<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserRegisterController extends Controller
{
    public function create()
    {
        return view('auth.userregister'); // 👈 Vue personnalisée
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'role' => 'user', // obligatoire
    ]);

    // Optionnel : connecter directement l'utilisateur
    Auth::login($user);

    return redirect()->route('index'); // redirige vers la page d’accueil publique
}

}
