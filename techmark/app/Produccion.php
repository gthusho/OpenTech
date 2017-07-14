<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    protected $table = 'producciones';
    protected $fillable = [
        'destino','fecha','registro','trabajador_id','usuario_id','inicio','fin','sucursal_id','estado'
    ];

    function detalle()
    {
        return $this->hasMany('App\DetalleProduccion', 'produccion_id', 'id');
    }
    function sucursal()
    {
        return $this->belongsTo('App\Sucursal', 'sucursal_id', 'id');
    }
    function usuario()
    {
        return $this->belongsTo('App\User', 'usuario_id', 'id');
    }
    function trabajador()
    {
        return $this->belongsTo('App\Trabajador', 'trabajador_id', 'id');
    }
    function almacen()
    {
        return $this->belongsTo('App\Almacen', 'almacen_id', 'id');
    }
    function totalPrecio(){
        $total = DetalleProduccion::where('produccion_id',$this->id)->sum('precio');
        if($total==null || $total=='')
            return '0' ;
        else
            return $total;
    }
    function totalCantidad(){
        $total =  DetalleProduccion::where('produccion_id',$this->id)->count();
        return $total;
    }
    function getCode(){
        return 'P'.sprintf("%06d", $this->id);
    }
    function scopeFecha($query,$fecha){
        if(trim($fecha) != ''){
            $query->where('fecha',$fecha);
        }
    }
    function scopeTrabajador($query,$x){
        if(trim($x) != ''){
            $query->where('trabajador_id', $x);
        }
    }
    function scopeSucursal($query,$x){
        if(trim($x) != ''){
            $query->where('sucursal_id', $x);
        }
    }
    function scopeDestino($query,$x){
        if(trim($x)!=''){
            $query->where('destino','like',"%$x%");
        }
    }
    function scopeCodigo($query,$p){
        if(trim($p) != ''){
            $pre = str_replace('P','',$p);
            $query->where('id',$pre);
        }
    }

}
