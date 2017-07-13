<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'caja';
    protected $fillable = [
        'usuario_id','sucursal_id','apertura','cierre','registro','observaciones','fcierre','estado'
    ];



    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }

    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }

    function scopeFecha($query,$fecha){
        if(trim($fecha) != ''){
            $fecha2=$fecha." 23:59:59";
            $query->whereBetween('registro',[$fecha,$fecha2]);
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

    function activo(){
        if($this->estado=='p')
            return ['default','Activo'];
        else
            return ['danger','Cerrado'];
    }
}
