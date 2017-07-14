<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 21/06/2017
 * Time: 11:32 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'razon_social', 'nit', 'telefono',
        'direccion',
        'email'
    ];
    function cotizacionarticulo(){
        return $this->belongsTo('App\CotizacionArticulo','id','cliente_id');
    }
    function ventaarticulo(){
        return $this->belongsTo('App\VentaArticulo','id','cliente_id');
    }
    function cotizacionproducto(){
        return $this->belongsTo('App\CotizacionProducto','id','cliente_id');
    }
    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('razon_social','like',"%$name%")
                ->orwhere('nit','like',"%$name%");
        }
    }
    function scopeCliente($query,$name){
        if(trim($name) != ''){
            $query->where('razon_social','like',"%$name%")
                ->orwhere('nit','like',"%$name%");
        }
    }
    function  deleteOk(){
        /*$num = Inmueble::where('usuarios_id',$this->id)->count();
        if($num>0)
            return false;
        else*/
        return true;
    }

}