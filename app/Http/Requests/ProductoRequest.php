<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'precio_sin_iva' => 'required',
            'costo_unitario' => 'required',
            'id_categoria' => 'required',
            'exento' => 'required',
            'description' => 'required',
            'upc' => 'required',
            'contenido_neto' => 'required',
            'unidad' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El nombre es obligatorio.',
            'precio_sin_iva.required' => 'El precio sin IVA es obligatorio.',
            'costo_unitario.required' => 'El costo unitario es obligatorio.',
            'id_categoria.required' => 'La categoría es obligatorio.',
            'exento.required' => 'La exento es obligatorio.',
            'description.required' => 'La descripción es obligatorio.',
            'upc.required' => 'La UPC es obligatorio.',
            'contenido_neto.required' => 'El contenido neto es obligatorio.',
            'unidad.required' => 'El unidad neto es obligatorio.',
        ];
    }
}
