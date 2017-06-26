<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    protected $fillable = [
        'nombre','direccion','direccion','telefono','celular','nit','usuario_id','ciudad_id','estado'
    ];
    function ciudad(){
        return $this->belongsTo('App\Ciudad','ciudad_id','id');
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%");
        }
    }
    function depositos(){
        return $this->hasMany('App\AlmacenSucursal','sucursal_id','id');
    }
    function  deleteOk(){
        $num = AlmacenSucursal::where('sucursal_id',$this->id)->count();
        $num+= Trabajador::where('sucursal_id',$this->id)->count();
        if($num>0)
            return false;
        else
        return true;
    }
}
