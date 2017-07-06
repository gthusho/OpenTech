<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCotizacionProducto extends Model
{
    protected $table = 'detalle_cotizaciones_productos';

    protected $fillable = [
        'productos_base_id','cantidad','precio','registro','usuario_id','material_id','sucursal_id','cotizacion_producto_id','talla_id','descripcion'
    ];

    function productobase(){
        return $this->belongsTo('App\ProductoBase','productos_base_id','id');
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function material(){
        return $this->belongsTo('App\Material','material_id','id');
    }
    function cotizacion(){
        return $this->belongsTo('App\CotizacionProducto','cotizacion_producto_id','id');
    }
    function talla(){
        return $this->belongsTo('App\Talla','talla_id','id');
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
}
