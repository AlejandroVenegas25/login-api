<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Registro de usuario
    public function register(Request $request)
    {
        \Log::info('Datos recibidos:', $request->all());

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6',
        ]);

        $usuario = new Usuario();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return response()->json([
            'acceso' => 'Ok',
            'mensaje' => 'Usuario registrado correctamente',
            'usuario' => $usuario
        ], 201);
    }

    // Inicio de sesión
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return response()->json([
                'acceso' => 'No',
                'error' => 'Credenciales incorrectas'
            ], 401);
        }

        return response()->json([
            'acceso' => 'Ok',
            'mensaje' => 'Acceso concedido',
            'usuario' => $usuario
        ], 200);
    }
}
