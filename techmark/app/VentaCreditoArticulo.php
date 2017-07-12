<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaCreditoArticulo extends Model
{
    protected $table = 'ventas_credito_articulos';
    protected $fillable = [
        'venta_articulo_id','abono','registro','usuario_id','fecha'
    ];



    function detalleventas(){
        return $this->belongsTo('App\VentaArticulo','venta_articulo_id','id');
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
}
