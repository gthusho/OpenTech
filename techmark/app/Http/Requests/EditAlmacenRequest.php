<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 22/06/2017
 * Time: 02:48 PM
 */

namespace App\Http\Requests;


class EditAlmacenRequest extends Request
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

        ];
    }
}