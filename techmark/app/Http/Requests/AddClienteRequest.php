<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 22/06/2017
 * Time: 09:07 AM
 */

namespace App\Http\Requests;


class AddClienteRequest extends Request
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
            'nit'=>'required|min:7|max:15|unique:clientes,nit',
            'telefono' => 'integer',
            'direccion'=>'max:100'
        ];
    }
}