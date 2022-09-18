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

    public function messages()
    {
        return [
            'name.required'         => "El nombre es obligatorio",
            'name.string'           => "El nombre indicado no es valido valido",
            'name.max'              => "El nombre no debe superar los 255 caracteres",
            'email.required'        => "El email es obligatorio",
            'email.string'          => "El email no es valido",
            'email.email'           => "Formato de email no valido",
            'email.max'             => "El email no debe superar los 255 caracteres",
            'email.unique'          => "Ya se ha registrado el email indicado",
            'password.required'     => "La password es obligatoria",
            'password.min'          => "La password debe tener un minimo de 8 caracteres",
            'password.regex'        => "la password debe contener una mayuscula, una minuscula, un numero y un caracter especial entre (!$#%@)",
            'password.confirm'      => "Las password no coinciden",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      =>  ['required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
                'confirmed'],
        ];
    }
}
