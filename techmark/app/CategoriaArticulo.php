<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Articulo;

class CategoriaArticulo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'categorias_articulos';
    protected $fillable = [
        'nombre',
        'registro',
        'estado'
    ];

    function articulo(){
    	return $this->hasMany('App\Articulo','id','categoria_articulo_id');
    }

    function scopeCategoria($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%");
        }
    }
    function  deleteOk(){
        $num = Articulo::where('categoria_articulo_id',$this->id)->count();
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