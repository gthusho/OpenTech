<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExistenciaArticulo extends Model
{
    protected $table = 'existencia_articulo';
    protected $fillable = [
        'sucursal_id','almacen_id','cantidad','articulo_id'
    ];
    function articulo(){
        return $this->belongsTo('App\Articulo','articulo_id','id');
    }
    function marca(){
        return $this->belongsTo('App\Marca','marca_id','id');
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function almacen(){
        return $this->belongsTo('App\Almacen','almacen_id','id');
    }
    function categoria(){
        return $this->belongsTo('App\CategoriaArticulo','categoria_articulo_id','id');
    }
    function scopeCategoria($query,$x){
        if(trim($x) != ''){
            $query->where('categoria_articulo_id', $x);
        }
    }
    function scopeArticulo($query,$name){
        if(trim($name) != ''){
            /* $id=Ingresos::articulo($name)->pluck('id');*/
            $query->where('articulo_id',$name);
        }
    }
    function scopeSucursal($query,$x){
        if(trim($x) != ''){
            $query->where('sucursal_id', $x);
        }
    }
    function scopeMarca($query,$x){
        if(trim($x) != ''){
            $query->where('marca_id', $x);
        }
    }
}