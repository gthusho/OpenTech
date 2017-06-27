<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $table = 'tallas';
    protected $fillable = [
        'nombre',
        'registro',
        'estado'
    ];

    function detprodbase(){
        return $this->hasMany('App\DetalleProductoBase','id','talla_id');
    }

    function scopeTalla($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%");
        }
    }
    function  deleteOk(){
        $num = DetalleProductoBase::where('talla_id',$this->id)->count();
        if($num>0)
            return false;
        else
            return true;
    }

    function activo(){
        if($this->estado==1)
            return ['default','Activo'];
        else
            return ['danger','Inactivo'];
    }
}
