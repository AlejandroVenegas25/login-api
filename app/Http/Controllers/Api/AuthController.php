<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Registro de usuario
    public function register(Request $request)
    {
        \Log::info('Datos recibidos:', $request->all());
        $request->headers->set('Accept', 'application/json');

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'acceso' => 'Ok',
            'mensaje' => 'Usuario registrado correctamente',
            'user' => $user
        ], 201);
    }

    // Inicio de sesión
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'acceso' => 'No',
                'error' => 'Credenciales incorrectas'
            ], 401);
        }

        return response()->json([
            'acceso' => 'Ok',
            'mensaje' => 'Acceso concedido',
            'user' => $user
        ], 200);
    }
}
