<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoBase extends Model
{
    protected $table = 'productos_base';
    protected $fillable = [
        'descripcion',
        'registro',
        'estado',
        'usuario_id'
    ];

    function detprodbase(){
        return $this->hasMany('App\DetalleProductoBase','producto_base_id','id');
    }

    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }

    function scopeProdBase($query,$name){
        if(trim($name) != ''){
            $query->where('descripcion','like',"%$name%");
        }
    }
    function  deleteOk(){
        $num = DetalleProductoBase::where('producto_base_id',$this->id)->count();
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
