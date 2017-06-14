<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    //
    protected $table = 'visita';
    protected $primaryKey = 'IdVisita';
    protected $fillable = [
        'IdCliente', 
        'FechaVisitar',
        'FechaVisitada',
        'Direccion',
        'Telefono',
        'IdUsuario',
        'FechaModificacion',
        'EstadoVisita',
        'estado',
        'descripcion'
        //aqui se pone todos tus campos en array
    ];
///public $timestamps = false;  ya no es neceario que usen esto en el modelo


    function usuario(){
        return $this->belongsTo('App\User','IdUsuario','IdUsuario');
    }
    function cliente(){
        return $this->belongsTo('App\Cliente','IdCliente','IdCliente');
    }
    function fechaV(){
        if($this->FechaVisitada=='')
            return '';
        else
            return Tool::fechaCastellano($this->FechaVisitada);
    }
    function activo(){

        switch ($this->estado){
            case 'a':{
                return ['default','Activo'];
            }
            case 's' :{
                return ['inverse','Suspendido'];
            }
            case 'c':{
                return ['danger','Cancelado'];
            }
            default: return ['inverse','error'];

        }
    }
    function  deleteOk(){
        /*$num = Inmueble::where('usuarios_id',$this->id)->count();
        if($num>0)
            return false;
        else*/
        return true;
    }
}