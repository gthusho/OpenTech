<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $table = 'gastos';
    protected $fillable = [
        'usuario_id','sucursal_id','monto','registro','fecha','descripcion'
    ];



    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }

    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
}
