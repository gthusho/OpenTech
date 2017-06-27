<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 21/06/2017
 * Time: 11:39 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $table = 'trabajadores';
    protected $fillable = [
        'nombre', 'direccion', 'telefono',
        'email','fecha_ingreso','cargo','foto','ci','estado','referencia','tel_referencia',
        'sueldo','usuario_id','sucursal_id'
    ];
    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%")
                ->orwhere('ci','like',"%$name%");
        }
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function activo(){
        switch ($this->estado){
            case '1':{
                return ['default','Activo'];
            }
            case '0' :{
                return ['danger','Inactivo'];
            }
            default: return ['inverse','error'];
        }
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function getFoto(){
        return url(\Config::get('upload.trabajadores').$this->foto);
    }
}