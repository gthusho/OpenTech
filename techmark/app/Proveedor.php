<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 22/06/2017
 * Time: 04:10 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = [
        'razon_social', 'nit', 'telefono',
        'celular','email','fax','direccion','registro'
    ];

    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('razon_social','like',"%$name%")->orwhere('nit','like',"%$name%");
        }
    }

}