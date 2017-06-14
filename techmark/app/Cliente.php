<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = 'cliente';
    protected $primaryKey = 'IdCliente';
    protected $fillable = [
        'RazonSocial', 'CorreoElectronico', 'Nit',
        'Direccion',
        'Telefono',
        'Foto',
        'FechaModificacion',
        'Activo',
        'IdUsuario'//aqui se pone todos tus campos en array
    ];
///public $timestamps = false;  ya no es neceario que usen esto en el modelo
   function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('RazonSocial','like',"%$name%")
            ->orwhere('Nit','like',"%$name%");
        }
    }
    function usuario(){
       return $this->belongsTo('App\User','IdUsuario','IdUsuario');
    }
    function  deleteOk(){
        /*$num = Inmueble::where('usuarios_id',$this->id)->count();
        if($num>0)
            return false;
        else*/
        return true;
    }

}