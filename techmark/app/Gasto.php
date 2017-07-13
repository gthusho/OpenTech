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

    function scopeFecha($query,$fecha){
        if(trim($fecha) != ''){
            $query->where('fecha',$fecha);
        }
    }

    function scopeUsuario($query,$x){
        if(trim($x) != ''){
            $query->where('usuario_id', $x);
        }
    }

    function scopeSucursal($query,$x){
        if(trim($x) != ''){
            $query->where('sucursal_id', $x);
        }
    }
}
