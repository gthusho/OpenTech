<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 22/06/2017
 * Time: 04:13 PM
 */

namespace App\Http\Requests;


class EditTrabajadorRequest extends Request
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
            'nombre' => 'required|unique:trabajadores,nombre,'.$this->route()->getParameter('trabajador').'|min:4',
            'ci'=>'required|unique:trabajadores,ci,'.$this->route()->getParameter('trabajador').'|min:6|max:15',
            'direccion' => 'max:150|required',
            'telefono'=>'integer|required',
            'fecha_ingreso'=>'required',
            'cargo'=>'required',
            'referencia'=>'required',
            'sueldo'=>'required',
            'tel_referencia'=>'integer|required',
            'sucursal'=>'required'
        ];
    }
}