<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotizacionProducto extends Model
{
    protected $table = 'cotizacionnes_productos';
    protected $fillable = [
        'registro','usuario_id','cliente_id','sucursal_id'
    ];



    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function almacen(){
        return $this->belongsTo('App\Almacen','almacen_id','id');
    }
    function cliente(){
        return $this->belongsTo('App\Clientes','cliente_id','id');
    }
    function detalle(){
        return $this->hasMany('App\DetalleCotizacionProducto','cotizacion_producto_id','id');
    }
    function totalPrecio(){
        $total = DetalleCotizacionProducto::where('cotizacion_producto_id',$this->id)->sum('precio');
        if($total==null || $total=='')
            return '0' ;
        else
            return $total;
    }
    function totalCantidad(){
        $total =  DetalleCotizacionProducto::where('cotizacion_producto_id',$this->id)->count();
        return $total;
    }
    function getCode(){
        return 'CO'.sprintf("%06d", $this->id);
    }
    function scopeFecha($query,$fecha){
        if(trim($fecha) != ''){
            $fecha2=$fecha." 23:59:59";
            $query->whereBetween('registro',[$fecha,$fecha2]);
        }
    }
    function scopeCodigo($query,$co){
        if(trim($co) != ''){
            $pre = str_replace('CO','',$co);
            $query->where('id',$pre);
        }
    }
}
