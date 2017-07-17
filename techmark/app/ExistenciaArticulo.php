<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExistenciaArticulo extends Model
{
    protected $table = 'existencia_articulo';
    function articulo(){
        return $this->belongsTo('App\Articulo','articulo_id','id');
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function almacen(){
        return $this->belongsTo('App\Almacen','almacen_id','id');
    }
}
