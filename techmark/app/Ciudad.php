<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 21/06/2017
 * Time: 11:39 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudades';
    protected $fillable = [
        'nombre', 'departamento', 'registro',
        'estado'
    ];

    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%");
        }
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