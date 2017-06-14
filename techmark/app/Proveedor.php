<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';

    protected $primaryKey = 'IdProveedor';

    ///public $timestamps = false;  ya no es neceario que usen esto en el modelo

    protected $fillable = [
    	'Nit',
    	'RazonSocial',
    	'Direccion',
    	'Telefono',
    	'CorreoElectronico',
    	'Foto',
    	'FechaModificacion',
    	'Activo'
    ];

    function scopeRazon($query,$name){
        if(trim($name) != ''){
            $query->where('RazonSocial','like',"%$name%")
            ->orwhere('Nit','like',"%$name%");
        }
    }

    function  deleteOk(){
        /*$num+=Stock::where('IdAlmacen',$this->IdAlmacen)->count();
        if($num>0)
            return false;
        else*/
            return true;
    }

}
