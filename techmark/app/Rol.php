<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';
    protected $primaryKey = 'IdRol';
    protected $fillable = ['Descripcion','IdUsuario','Activo'];
    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('Descripcion','like',"%$name%");
        }
    }
    function activo(){
        if($this->Activo==1)
            return ['default','Activo'];
        else
            return ['danger','Inactivo'];
    }
    function  deleteOk(){
        $num = User::where('IdRol',$this->IdRol)->count();
        if($num>0)
            return false;
        else
        return true;
    }
}
