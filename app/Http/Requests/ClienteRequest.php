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
        $rules = [
            'name' => 'required',
            'identificacion' => 'required|max:11|regex:/[a-zA-Z]{1}-[0-9]{6,10}/|unique:cliente,identificacion,' . $this->id,
            'telefono' => 'required|regex:/[0]{1}[\d]{3}-[0-9]{7}/',
            'direccion' => 'required',
        ];

        // Si es diferente a Post
        if($this->method() !== 'PUT')
        {
            $rules ['correo' ] = 'required|string|email:rfc|max:255|regex:/^[\w.-]+@[\w]+\.{1}[\w]+(.{1}[\w])*$/|unique:cliente,correo,' . $this->id;

        }

        return $rules;      

    }

    public function messages(){
        return [
            'name.required' => 'Obligatorio.',
            'identificacion.required' => 'Obligatorio.',
            'identificacion.max' => 'Debe ser máximo 11 caracteres.',
            'identificacion.regex' => 'El RIF/CI con formato inválido.',
            'identificacion.unique' => 'El RIF/CI ya esta registrado.',
            'telefono.required' => 'Obligatorio.',
            'telefono.numeric' => 'El teléfono debe tener solo números.',
            'telefono.regex' => 'Formato inválido.',
            'direccion.required' => 'Obligatorio.',
            'correo.required' => 'Obligatorio.',
            'correo.email' => 'Debe ser una dirección válida.',
            'correo.unique' => 'El correo ya esta registrado.',
            'correo.regex' => 'Formato inválido.',
        ];
    }
}
