<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'identificacion' => 'required|max:11|regex:/[a-zA-Z]{1}-[0-9]{6,10}/',
            'telefono' => 'required|numeric|regex:/[0-9]{11}/',
            'direccion' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El Nombre/Razón Social es obligatorio.',
            'identificacion.required' => 'El RIF/CI es obligatorio.',
            'identificacion.max' => 'El RIF/CI debe ser máximo 11 caracteres.',
            'identificacion.regex' => 'El RIF/CI con formato inválido.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe tener solo números.',
            'telefono.regex' => 'El teléfono debe contener 11 números.',
            'direccion.required' => 'La dirección es obligatorio.',
        ];
    }
}
