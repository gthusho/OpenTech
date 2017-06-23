<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditArticuloRequest extends Request
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
            'nombre' => 'required|unique:articulos,nombre,'.$this->route()->getParameter('articulo').'|min:4',
            'codigo'=>'required|unique:articulos,codigo,'.$this->route()->getParameter('articulo').'|min:4|max:45',
            'categoria_articulo_id' => 'integer|required',
            'marca_id'=>'integer|required',
            'material_id'=>'integer|required',
            'medida_id'=>'integer|required',
            'costo'=>'required|numeric',
            'precio1'=>'required|numeric',
            'precio2'=>'numeric',
            'precio3'=>'numeric',
            'codigobarra'=>'max:45',
            'stock_min'=>'integer'
        ];
    }
}
