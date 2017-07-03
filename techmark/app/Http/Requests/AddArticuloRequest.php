<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddArticuloRequest extends Request
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
            'nombre' => 'required|unique:articulos,nombre|min:4',
            'codigo'=>'required|min:4|max:45|unique:articulos,codigo',
            'categoria_articulo_id' => 'integer|required',
            'marca_id'=>'integer|required',
            'material_id'=>'integer|required',
            'unidad_id'=>'integer|required',
            'costo'=>'required',
            'precio1'=>'required',
            'precio2'=>'required',
            'precio3'=>'required',
            'codigobarra'=>'max:45|unique:articulos,codigobarra',
            'stock_min'=>'required'
        ];
    }
}
