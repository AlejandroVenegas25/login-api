<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GastoRequest;
use App\Models\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    // GET /api/gastos
    public function index()
    {
        return Gasto::orderBy('fecha','desc')->get();
    }

    // POST /api/gastos
    public function store(GastoRequest $request)
    {
        $gasto = Gasto::create($request->validated());
        return response()->json($gasto, 201);
    }

    // GET /api/gastos/{id}
    public function show($id)
    {
        $gasto = Gasto::findOrFail($id);
        return $gasto;
    }

    // PUT/PATCH /api/gastos/{id}
    public function update(GastoRequest $request, $id)
    {
        $gasto = Gasto::findOrFail($id);
        $gasto->update($request->validated());
        return response()->json($gasto, 200);
    }

    // DELETE /api/gastos/{id}
    public function destroy($id)
    {
        $gasto = Gasto::findOrFail($id);
        $gasto->delete();
        return response()->json(null, 204);
    }
}
