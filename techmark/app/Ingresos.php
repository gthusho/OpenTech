<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    protected $table = 'ingresos';

    function articulo(){
        return $this->belongsTo('App\Articulo','articulo_id','id');
    }
    public  function  setCostoAttribute($value){
        if(!empty($value)){
            $this->attributes['costo']=\str_replace(",","",$value);
        }

    }
    public  function  setPrecio1Attribute($value){
        if(!empty($value)){
            $this->attributes['cantidad']=\str_replace(",","",$value);
        }

    }
    function usuario(){
    return $this->belongsTo('App\User','usuario_id','id');
}
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function almacen(){
        return $this->belongsTo('App\Almacen','almacen_id','id');
    }
    function compra(){
        return $this->belongsTo('App\Compra','compra_id','id');
    }
}