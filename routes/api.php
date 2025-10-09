<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas de la API para tu aplicación.
| Estas rutas se cargan por el RouteServiceProvider y todas
| serán asignadas al grupo de middleware "api".
|
*/

// Ruta de prueba para comprobar si la API responde
Route::get('/prueba', function () {
    return response()->json([
        'message' => 'API funcionando correctamente'
    ]);
});

// Rutas del Login y Registro
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
