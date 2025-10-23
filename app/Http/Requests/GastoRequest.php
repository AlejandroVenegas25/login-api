<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GastoRequest extends FormRequest
{
    public function authorize()
    {
        return true; // o aplicar lógica de autorización
    }

    public function rules()
    {
        return [
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:1000',
        ];
    }
}
