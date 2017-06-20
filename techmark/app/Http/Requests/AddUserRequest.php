<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddUserRequest extends Request
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
            'username' => 'required|unique:usuarios,username|min:4',
            'rol_id' => 'integer|required',
            'direccion'=>'required',
            'password' => 'required|confirmed|min:6'
        ];
    }
}
