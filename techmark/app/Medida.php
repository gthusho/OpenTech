<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    protected $table='medida';

    protected $primaryKey='IdMedida';

    ///public $timestamps = false;  ya no es neceario que usen esto en el modelo

    protected $fillable=[
    	'Descripcion',
    	'registro',
    	'IdUsuario',
    	'Activo'
    ];

    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('Descripcion','like',"%$name%");
        }
    }
    function usuario(){
        return $this->belongsTo('App\User','IdUsuario','IdUsuario');
    }
    function activo(){
        if($this->Activo==1)
            return ['default','Activo'];
        else
            return ['danger','Inactivo'];
    }
    function  deleteOk(){
        $num = Articulo::where('IdMedida',$this->IdMedida)->count();
        if($num>0)
            return false;
        else
            return true;
    }
}
