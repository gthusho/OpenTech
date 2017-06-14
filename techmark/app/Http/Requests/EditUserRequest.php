<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditUserRequest extends Request
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



        return  [
            'NombreUsuario' => 'required|min:4|unique:usuario,NombreUsuario,'.$this->route()->getParameter('usuario').',IdUsuario',
            'IdRol' => 'integer|required',
            'password' => 'confirmed|min:6'
        ];
    }
}
