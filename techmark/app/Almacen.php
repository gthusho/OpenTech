<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 21/06/2017
 * Time: 11:40 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacenes';
    protected $fillable = [
        'nombre', 'direccion', 'ciudad_id',
        'registro',
        'estado'
    ];
    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%");
        }
    }
    function ciudad(){
        return $this->belongsTo('App\Ciudad','ciudad_id','id');
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

}