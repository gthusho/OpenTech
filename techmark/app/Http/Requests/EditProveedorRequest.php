<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 22/06/2017
 * Time: 04:13 PM
 */

namespace App\Http\Requests;


class EditProveedorRequest extends Request
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
            'razon_social' => 'required|unique:proveedores,razon_social,'.$this->route()->getParameter('proveedor').'|min:4',
            'nit'=>'required|unique:proveedores,nit,'.$this->route()->getParameter('proveedor').'|min:7|max:15',
            'telefono' => 'integer',
            'celular'=>'integer',
            'fax'=>'integer',
            'direccion'=>'max:150'
        ];
    }
}