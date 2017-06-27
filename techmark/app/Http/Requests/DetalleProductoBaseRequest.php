<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DetalleProductoBaseRequest extends Request
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
            'producto_base_id'=>'required|integer',
            'talla_id'=>'required|integer',
            'material_id'=>'required|integer',
            'precio'=>'required',
            'costo'=>'required',
            'usuario_id'=>''
        ];
    }
}
