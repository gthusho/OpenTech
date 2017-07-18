<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'marcas';
    protected $fillable = [
        'nombre',
        'registro',
        'descripcion',
        'estado'
    ];

    function articulo(){
    	return $this->hasMany('App\Articulo','id','marca_id');
    }
    function existenciaarticulo(){
        return $this->belongsTo('App\ExistenciaArituclo','id','marca_id');
    }
    function scopeMarca($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%")
            ->orWhere('descripcion','like',"%$name%");
        }
    }
    function  deleteOk(){
        $num = Articulo::where('marca_id',$this->id)->count();
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
