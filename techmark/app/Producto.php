<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = [
        'descripcion',
        'imagen',
        'registro',
        'estado',
        'usuario_id',
        'fecha',
        'codigo',
        'codigobarra'
    ];

    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function tallas(){
        return $this->hasMany('App\ProductoTalla','producto_id','id');
    }
    function scopeProducto($query,$name){
        if(trim($name) != ''){
            $query->where('descripcion','like',"%$name%");
        }
    }
    function scopeCodigo($query,$name){
        if(trim($name) != ''){
            $query->where('codigo','like',"%$name%");
        }
    }
    function scopeBarra($query,$name){
        if(trim($name) != ''){
            $query->where('codigobarra','like',"%$name%");
        }
    }
    function activo(){
        if($this->estado==1)
            return ['default','Activo'];
        else
            return ['danger','Inactivo'];
    }

    function getImagen(){
        if(trim($this->imagen) != '')
            return url(\Config::get('upload.productos').$this->imagen);
        else
            return url(\Config::get('upload.productos').'defaultstore.jpg');
    }
    function  deleteOk(){
        $num = ExistenciaProducto::where('producto_id',$this->id)->count();
        $num += DetalleVentaProducto::where('producto_id',$this->id)->count();
        $num += IngresosProducto::where('producto_id',$this->id)->count();
        if($num>0)
            return false;
        else
            return true;
    }

}
