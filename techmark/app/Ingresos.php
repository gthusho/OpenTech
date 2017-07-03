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
}
