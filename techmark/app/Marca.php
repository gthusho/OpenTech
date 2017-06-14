<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table='marca';

    protected $primaryKey='IdMarca';

    ///public $timestamps = false;  ya no es neceario que usen esto en el modelo

    protected $fillable=[
    	'Descripcion',
    	'IdUsuario',
    	'Activo'
    ];
    function scopename($query,$name){
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
        $num = Articulo::where('IdMarca',$this->IdMarca)->count();
        if($num>0)
            return false;
        else
            return true;
    }
}
