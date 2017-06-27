<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditProductoBaseRequest extends Request
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
            'descripcion'=>'required|min:4|unique:productos_base,descripcion,'.$this->route()->getParameter('prodbase'),
            'usuario_id'=>''
        ];
    }
}
