<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVentaArticulo extends Model
{
    protected $table = 'detalles_ventas_articulos';

    protected $fillable = [
        'articulo_id','cantidad','precio','registro','usuario_id','dp','sucursal_id','venta_articulo_id'
    ];

    function articulo(){
        return $this->belongsTo('App\Articulo','articulo_id','id');
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function ventaarticulo(){
        return $this->belongsTo('App\VentaArticulo','venta_articulo_id','id');
    }
    function almacen(){
        return $this->belongsTo('App\Almacen','almacen_id','id');
    }
    public  function  setPrecioAttribute($value){
        if(!empty($value)){
            $this->attributes['precio']=\str_replace(",","",$value);
        }

    }
    public  function  setCantidadAttribute($value){
        if(!empty($value)){
            $this->attributes['cantidad']=\str_replace(",","",$value);
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
    function scopeFecha($query,$fecha){
        if(trim($fecha) != ''){
            $date = Tool::getArrayDate($fecha);
            $query->where(\DB::raw('date(registro)'),'>=',\DB::raw('date("'.$date[0].'")'))->where(\DB::raw('date(registro)'),'<=',\DB::raw('date("'.$date[1].'")'));
        }
    }
    function scopeFecha2($query,$fecha){
        if(trim($fecha) != ''){
            $date = Tool::getArrayDate2($fecha);
            $query->where(\DB::raw('date(registro)'),'>=',\DB::raw('date("'.$date[0].'")'))->where(\DB::raw('date(registro)'),'<=',\DB::raw('date("'.$date[1].'")'));
        }
    }
    function scopeUsuario($query,$x){
        if(trim($x) != ''){
            $query->where('usuario_id', $x);
        }
    }
}
