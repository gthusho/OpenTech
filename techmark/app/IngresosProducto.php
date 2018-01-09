<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngresosProducto extends Model
{
    protected $table = 'ingresos_productos';
    protected $fillable = [
        'sucursal_id','producto_id','produccion_id','registro'
    ];
    function  sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function talla(){
        return $this->belongsTo('App\Talla','talla_id','id');
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function produccion(){
        return $this->belongsTo('App\Produccion','produccion_id','id');
    }

    function producto()
    {
        return $this->belongsTo('App\Producto', 'producto_id', 'id');
    }
    function scopeSucursal($query,$x){
        if(trim($x) != ''){
            $query->where('sucursal_id', $x);
        }
    }
    function scopeProducto($query,$x){
        if(trim($x) != ''){
            $query->where('producto_id', $x);
        }
    }
    function scopeTalla($query,$x){
        if(trim($x) != ''){
            $query->where('talla_id', $x);
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
}
