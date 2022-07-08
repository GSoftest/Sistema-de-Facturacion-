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
            'precio_sin_iva' => 'required|numeric',
            'costo_unitario' => 'required|numeric',
            'id_categoria' => 'required',
            'exento' => 'required',
            'description' => 'required',
            'upc' => 'required|numeric|digits_between:12,12',
            'contenido_neto' => 'required',
            'unidad' => 'required|numeric',
            'peso'=> 'numeric',
            'altura'=> 'numeric',
            'ancho'=> 'numeric',
            'longitud'=> 'numeric',
            'imagen_url' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El nombre es obligatorio.',
            'precio_sin_iva.required' => 'El precio sin IVA es obligatorio.',
            'precio_sin_iva.numeric' => 'El precio sin IVA debe ser numérico.',
            'costo_unitario.required' => 'El costo unitario es obligatorio.',
            'costo_unitario.numeric' => 'El costo unitario debe ser numérico.',
            'id_categoria.required' => 'La categoría es obligatorio.',
            'exento.required' => 'La exento es obligatorio.',
            'description.required' => 'La descripción es obligatorio.',
            'upc.required' => 'La UPC es obligatorio.',
            'upc.numeric' => 'La UPC debe ser numérico.',
            'upc.digits_between' => 'La UPC debe ser 12 dígitos numéricos.',
            'contenido_neto.required' => 'El contenido neto es obligatorio.',
            'unidad.required' => 'La unidad es obligatorio.',
            'unidad.numeric' => 'La unidad debe ser numérico.',
            'peso.numeric'=> 'El peso debe ser numérico',
            'altura.numeric'=> 'El altura debe ser numérico',
            'ancho.numeric'=> 'El ancho debe ser numérico',
            'longitud.numeric'=> 'El longitud debe ser numérico',
            'imagen_url.image' => 'El archivo debe ser una imagen.',
            'imagen_url.mimes' => 'La imagen debe ser jpeg,png,jpg,bmp,gif,svg.',
        ];
    }
}
