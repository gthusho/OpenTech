<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    protected $fillable = [
        'nombre','direccion','direccion','telefono','celular','nit','usuario_id','ciudad_id','estado'
    ];
    function ciudad(){
    return $this->belongsTo('App\Ciudad','ciudad_id','id');
}
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function ingreso(){
        return $this->belongsTo('App\Ingreso','id','sucursal_id');
    }
    function gasto(){
        return $this->belongsTo('App\Gasto','id','sucursal_id');
    }
    function caja(){
        return $this->belongsTo('App\Caja','id','sucursal_id');
    }
    function cotizacionarticulo(){
        return $this->belongsTo('App\CotizacionArticulo','id','sucursal_id');
    }
    function cotizacionproducto(){
        return $this->belongsTo('App\CotizacionProducto','id','sucursal_id');
    }
    function detalleventaarticulo(){
        return $this->belongsTo('App\DetalleVentaArticulo','id','sucursal_id');
    }
    function ventaarticulo(){
        return $this->belongsTo('App\VentaArticulo','id','sucursal_id');
    }
    function compra(){
        return $this->belongsTo('App\Compra','id','sucursal_id');
    }
    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%");
        }
    }
    function scopeSucursal($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%");
        }
    }
    function almacen(){
        return $this->hasOne('App\Almacen','sucursal_id','id');
    }
    function  deleteOk(){
        $num = Almacen::where('sucursal_id',$this->id)->count();
        $num+= Trabajador::where('sucursal_id',$this->id)->count();
        if($num>0)
            return false;
        else
        return true;
    }
    function totalGasto($query,$fecha){
        $total = Gasto::where('sucursal_id',$this->id)->sum('monto');
        if($total==null || $total=='')
            return '0' ;
        else
            return $total;
    }
}
