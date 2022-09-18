<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password.required'     => "La passwod es obligatoria",
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
            'password'              =>  ['required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
                'confirmed'],
        ];
    }
}
