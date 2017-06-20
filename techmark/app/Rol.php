<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['nombre','estado'];
    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%");
        }
    }
    function activo(){
        if($this->estado==1)
            return ['default','Activo'];
        else
            return ['danger','Inactivo'];
    }
    function  deleteOk(){
        $num = User::where('rol_id',$this->id)->count();
        if($num>0)
            return false;
        else
        return true;
    }
}
