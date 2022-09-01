<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
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
            'precio_sin_iva' => 'required|regex:/^[\d]+([,][\d]+)?$/',
            'costo_unitario' => 'required|regex:/^[\d]+([,][\d]+)?$/',
            'id_categoria' => 'required',
            'id_proveedor' => 'required',
            'exento' => 'required',
            'description' => 'required',
            'upc' => 'nullable|numeric|digits_between:12,12',
            'contenido_neto' => 'required',
            'unidad' => 'required|numeric',
            'altura'=> 'nullable|numeric',
            'ancho'=> 'nullable|numeric',
            'imagen_url' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Obligatorio.',
            'precio_sin_iva.required' => 'Obligatorio.',
            'precio_sin_iva.regex' => 'El precio con formato inválido.',
            'costo_unitario.required' => 'Obligatorio.',
            'costo_unitario.regex' => 'El costo con formato inválido.',
            'id_categoria.required' => 'Obligatorio.',
            'id_proveedor.required' => 'Obligatorio.',
            'exento.required' => 'Obligatorio.',
            'description.required' => 'Obligatorio.',
            'upc.required' => 'Obligatorio.',
            'upc.numeric' => 'La UPC debe ser numérico.',
            'upc.digits_between' => 'La UPC debe ser 12 dígitos numéricos.',
            'contenido_neto.required' => 'Obligatorio.',
            'unidad.required' => 'Obligatorio.',
            'unidad.numeric' => 'La unidad debe ser numérico.',
            'altura.numeric'=> 'El altura debe ser numérico',
            'ancho.numeric'=> 'El ancho debe ser numérico',
            'imagen_url.image' => 'El archivo debe ser una imagen.',
            'imagen_url.mimes' => 'La imagen debe ser jpeg,png,jpg,bmp,gif,svg.',
        ];
    }
}
