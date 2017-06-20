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
            'username' => 'required|min:4|unique:usuarios,username,'.$this->route()->getParameter('usuario'),
            'rol_id' => 'integer|required',
            'direccion'=>'required',
            'password' => 'confirmed|min:6'
        ];
    }
}
