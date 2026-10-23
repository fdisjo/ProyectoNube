<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nick_usuario' => ['required'],
            'contrasena_usuario' => ['required'],
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt([
            'nick_usuario' => $request->nick_usuario,
            'password' => $request->contrasena_usuario,
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('/pos');
        }

        return back()->withErrors([
            'nick_usuario' => 'Las credenciales proporcionadas no son válidas.',
        ]);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}