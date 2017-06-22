<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'materiales';
    protected $fillable = [
        'nombre',
        'descripcion',
        'registro',
        'estado'
    ];

    function articulo(){
    	return $this->hasMany('App\Articulo','id','material_id');
    }

    function scopeMaterial($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%")
            ->orWhere('descripcion','like',"%$name%");
        }
    }
    function  deleteOk(){
        $num = Articulo::where('material_id',$this->id)->count();
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
