<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'caja';
    protected $fillable = [
        'usuario_id','sucursal_id','apertura','cierre','registro','observaciones'
    ];



    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }

    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
}
