<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoArticulo extends Model
{
    protected $table='tipoarticulo';

    protected $primaryKey='IdTipoArticulo';

    ///public $timestamps = false;  ya no es neceario que usen esto en el modelo

    protected $fillable=[
    	'Descripcion',
    	'IdUsuario',
        'registro',
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
        $num = Articulo::where('IdTipoArticulo',$this->IdTipoArticulo)->count();
        if($num>0)
            return false;
        else
            return true;
    }
}
