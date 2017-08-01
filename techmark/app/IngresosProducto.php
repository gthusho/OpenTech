<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngresosProducto extends Model
{
    protected $table = 'ingresos_productos';

    function  sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function talla(){
        return $this->belongsTo('App\Talla','talla_id','id');
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function produccion(){
        return $this->belongsTo('App\Produccion','produccion_id','id');
    }

    function producto()
    {
        return $this->belongsTo('App\Producto', 'producto_id', 'id');
    }
}
