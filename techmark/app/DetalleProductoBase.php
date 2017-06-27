<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleProductoBase extends Model
{
    protected $table = 'detalle_productos_base';
    protected $fillable = [
        'producto_base_id',
        'talla_id',
        'material_id',
        'precio',
        'costo',
        'registro',
        'usuario_id'
    ];

    function prodbase(){
        return $this->belongsTo('App\ProductoBase','producto_base_id','id');
    }

    function talla(){
        return $this->belongsTo('App\Talla','talla_id','id');
    }

    function material(){
        return $this->belongsTo('App\Material','material_id','id');
    }

    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }

    function scopeDetProdBase($query,$name){
        if(trim($name) != ''){
            $id=ProductoBase::prodBase($name)->pluck('id');
            $query->whereIn('producto_base_id',$id);
        }
    }

    function scopeTalla($query,$x){
        if(trim($x) != ''){
            $query->where('talla_id', $x);
        }
    }
    function scopeMaterial($query,$x){
        if(trim($x) != ''){
            $query->where('material_id', $x);
        }
    }

    public  function  setCostoAttribute($value){
        if(!empty($value)){
            $this->attributes['costo']=\str_replace(",","",$value);
        }
    }

    public  function  setPrecioAttribute($value){
        if(!empty($value)){
            $this->attributes['precio']=\str_replace(",","",$value);
        }
    }

}
