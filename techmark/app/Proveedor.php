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
    function compra(){
        return $this->belongsTo('App\Compra','id','proveedor_id');
    }
    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('razon_social','like',"%$name%")->orwhere('nit','like',"%$name%");
        }
    }
    function scopeProveedor($query,$name){
        if(trim($name) != ''){
            $query->where('razon_social','like',"%$name%");
        }
    }
    function  deleteOk(){
        $num = Compra::where('proveedor_id',$this->id)->count();
        if($num>0)
            return false;
        else
        return true;
    }

}