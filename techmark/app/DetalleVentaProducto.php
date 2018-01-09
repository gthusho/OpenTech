<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVentaProducto extends Model
{
    protected $table = 'detalles_ventas_productos';
    protected $fillable = [
        'producto_id','cantidad','precio','registro','usuario_id','dp','sucursal_id','venta_producto_id','talla_id'
    ];

    function producto(){
        return $this->belongsTo('App\Producto','producto_id','id');
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function talla(){
        return $this->belongsTo('App\Talla','talla_id','id');
    }
    function ventaproducto(){
        return $this->belongsTo('App\VentaProducto','venta_producto_id','id');
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
    function scopeProducto($query,$name){
        if(trim($name) != ''){
            /* $id=Ingresos::articulo($name)->pluck('id');*/
            $query->where('producto_id',$name);
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
    function scopeTalla($query,$x){
        if(trim($x) != ''){
            $query->where('talla_id', $x);
        }
    }
}
