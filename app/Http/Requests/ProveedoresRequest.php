<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class ProveedoresRequest extends FormRequest
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

        $rules = [
            'name' => 'required',
            'phone_number' => 'required|regex:/[0]{1}[\d]{3}-[0-9]{7}/',
        ];

        if($this->method() !== 'PUT')
        {
            $rules ['email' ] = 'required|string|email:rfc|max:255|regex:/^[\w.-]+@[\w]+\.{1}[\w]+(.{1}[\w])*$/|unique:providers,email,' . $this->id;

        }

        return $rules;      
    }

    public function messages(){
        return [
            'name.required' => 'Obligatorio.',
            'phone_number.required' => 'Obligatorio.',
            'phone_number.numeric' => 'El teléfono debe tener solo números.',
            'phone_number.regex' => 'Formato inválido.',
            'email.required' => 'Obligatorio.',
            'email.email' => 'Debe ser una dirección válida.',
            'email.unique' => 'El correo ya esta registrado.',
            'email.regex' => 'Formato inválido.',
        ];
    }
}
