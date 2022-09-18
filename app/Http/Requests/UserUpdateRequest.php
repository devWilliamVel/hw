<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name.string'           => "EL nombre no es valido",
            'name.min'              => "El nombre debe tener como minimo 2 caractres",
            'email.required'        => "El email es obligatorio",
            'email.email'           => "Formato de email no valido",
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
            'name'                  =>  'required|string|min:2',
            'email'                 =>  'required|email',
        ];
    }
}
