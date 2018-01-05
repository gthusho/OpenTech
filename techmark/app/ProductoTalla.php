<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoTalla extends Model
{
    protected $table = 'producto_tallas';
    protected $fillable = ['producto_id','talla_id','precio1','precio2','precio3','precio4','precio5'];
    function talla(){
        return $this->belongsTo('App\Talla','talla_id','id');
    }
    function producto(){
        return $this->belongsTo('App\Producto','producto_id','id');
    }
    public  function  setPrecio1Attribute($value){
        if(!empty($value)){
            $this->attributes['precio1']=\str_replace(",","",$value);
        }

    }
    public  function  setPrecio2Attribute($value){
        if(!empty($value)){
            $this->attributes['precio2']=\str_replace(",","",$value);
        }

    }
    public  function  setPrecio3Attribute($value){
        if(!empty($value)){
            $this->attributes['precio3']=\str_replace(",","",$value);
        }

    }
}
