<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */




    public function rules(): array
    {
        return [
           'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    // mensajes respectivos a cada regla de validacion
    public function messages () : array {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'name.max' => 'El nombre no debe exceder los 255 caracteres',

            'email.required' => 'El correo electronico es obligatorio',
            'email.string' => 'El correo electronico debe ser una cadena de texto',
            'email.email' => 'El correo electronico debe ser una direccion valida',
            'email.max' => 'El correo electronico no debe exceder los 255 caracteres',
            'email.unique' => 'El correo electronico ya está en uso',

            'password.required' => 'La contraseña es obligatoria',
            'password.string' => 'La contraseña debe ser una cadena de texto',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'La confirmación de la contraseña no coincide',
        ];
    }
}
