<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetProduccionCliente extends Model
{
    protected $table = 'producciones_clientes_detalles';

    protected $fillable = [
        'articulo_id','cantidad','registro','usuario_id','sucursal_id','produccion_cliente_id','precio','dp','almacen_id'
    ];

    function articulo(){
        return $this->belongsTo('App\Articulo','articulo_id','id');
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function produccion(){
        return $this->belongsTo('App\ProduccionCliente','produccion_cliente_id','id');
    }
    function almacen(){
        return $this->belongsTo('App\Almacen','almacen_id','id');
    }

    public  function  setPrecioAttribute($value){
        if(!empty($value)){
            $this->attributes['precio']=\str_replace(",","",$value);
        }

    }
    public  function  setCantidadAttribute($value){
        if(!empty($value)){
            $this->attributes['cantidad']=\str_replace(",","",$value);
        }

    }
    function scopeArticulo($query,$name){
        if(trim($name) != ''){
            $query->where('articulo_id',$name);
        }
    }
    function scopeSucursal($query,$x){
        if(trim($x) != ''){
            $query->where('sucursal_id', $x);
        }
    }

    function scopeFecha($query,$x){
        if(trim($x) != ''){
            $x2=$x." 23:59:59";
            $query->whereBetween('registro',[$x,$x2]);
        }
    }
}
