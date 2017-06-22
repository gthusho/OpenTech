<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'medidas';
    protected $fillable = [
        'nombre',
        'registro',
        'estado'
    ];

    function articulo(){
    	return $this->hasMany('App\Articulo','id','medida_id');
    }

    function scopeMedida($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%");
        }
    }
    function  deleteOk(){
        $num = Articulo::where('medida_id',$this->id)->count();
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
