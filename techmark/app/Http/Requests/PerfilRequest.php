<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PerfilRequest extends Request
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
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'integer|digits_between:5,12',
            'celular' => 'integer|digits_between:8,12',
            'email' => 'email',
            'password' => 'confirmed|min:6'
        ];
    }
}
