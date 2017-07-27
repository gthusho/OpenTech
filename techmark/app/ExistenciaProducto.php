<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExistenciaProducto extends Model
{
    protected $table = 'existencia_producto';
    protected $fillable = [
        'sucursal_id','almacen_id','cantidad','producto_id','talla_id'
    ];
    function producto(){
        return $this->belongsTo('App\Producto','producto_id','id');
    }
    function talla(){
        return $this->belongsTo('App\Talla','talla_id','id');
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function scopeProducto($query,$name){
        if(trim($name) != ''){
            /* $id=Ingresos::articulo($name)->pluck('id');*/
            $query->where('producto_id',$name);
        }
    }
    function scopeSucursal($query,$x){
        if(trim($x) != ''){
            $query->where('sucursal_id', $x);
        }
    }
    function scopeTalla($query,$x){
        if(trim($x) != ''){
            $query->where('talla_id', $x);
        }
    }
}
