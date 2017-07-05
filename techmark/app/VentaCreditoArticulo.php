<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaCreditoArticulo extends Model
{
    protected $table = 'ventas_credito_articulos';
    protected $fillable = [
        'venta_articulo_id','abono','registro','usuario_id'
    ];



    function detalleventas(){
        return $this->belongsTo('App\VentaArticulo','venta_articulo_id','id');
    }
}
