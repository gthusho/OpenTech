<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlmacenSucursal extends Model
{
    protected $table = 'almacen_sucursal';
    protected $fillable = ['almacen_id','sucursal_id'];

    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function almacen(){
        return $this->belongsTo('App\Almacen','almacen_id','id');
    }
}
