<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaCreditoProducto extends Model
{
    protected $table = 'ventas_credito_productos';
    protected $fillable = ['usuario_id','venta_producto_id','abono','fecha'];
    function detalleventas(){
        return $this->belongsTo('App\VentaProducto','venta_producto_id','id');
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
}
