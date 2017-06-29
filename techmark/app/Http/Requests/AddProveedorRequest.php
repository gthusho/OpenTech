<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 22/06/2017
 * Time: 04:13 PM
 */

namespace App\Http\Requests;


class AddProveedorRequest extends Request
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
            'razon_social' => 'required|unique:proveedores,razon_social|min:4',
            'nit'=>'required|min:7|max:15|unique:proveedores,nit',
            'telefono' => 'integer',
            'celular'=>'integer',
            'fax'=>'integer',
            'direccion'=>'max:150'
        ];
    }
}