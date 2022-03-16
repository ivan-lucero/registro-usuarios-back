<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required|max:20',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'name.max' => 'El :attribute no debe tener mas de 20 caracteres',
            'email.required' => 'El :attribute es obligatorio.',
            'email.email' => 'El :attribute ingresado no es un email.',
            'email.max' => 'El :attribute no debe tener mas de 191 caracteres.',
            'email.unique' => 'El :attribute ingresado ya existe.',
            'password.required' => 'La :attribute es obligatoria.',
            'password.min' => 'La :attribute debe tener mas de 6 caracteres.',
            'confirm_password.required' => 'La :attribute es obligatoria.',
            'confirm_password.min' => 'La :attribute debe tener mas de 6 caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre de usuario',
            'password' => 'contraseña',
            'confirm_password' => 'contraseña',
        ];
    }

}
