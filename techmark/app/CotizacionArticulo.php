<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 04/07/2017
 * Time: 01:57 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class CotizacionArticulo extends Model
{
    protected $table = 'cotizaciones_articulos';
    protected $fillable = [
        'registro','usuario_id','cliente_id','sucursal_id','estado','fvalides'
    ];
    function detallecotizacion(){
        return $this->hasMany('App\DetalleCotizacion','cotizacion_id','id');
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function cliente(){
        return $this->belongsTo('App\Clientes','cliente_id','id');
    }
    function totalPrecio(){
        $total = DetalleCotizacion::where('cotizacion_id',$this->id)->sum('precio');
        if($total==null || $total=='')
            return '0' ;
        else
            return $total;
    }
    function totalCantidad(){
        $total =  DetalleCotizacion::where('cotizacion_id',$this->id)->count();
        return $total;
    }
    function getCode(){
        return 'COT-'.sprintf("%06d", $this->id);
    }
    function scopeFecha($query,$fecha){
        if(trim($fecha) != ''){
            $date = Tool::getArrayDate($fecha);
            $query->where(\DB::raw('DATE(registro)'),'>=',$date[0])->where(\DB::raw('DATE(registro)'),'<=',$date[1]);

        }
    }
    function scopeCodigo($query,$v){
        if(trim($v) != ''){
            $pre = str_replace('COT-','',$v);
            $query->where('id',$pre);
        }
    }
    function scopeSucursal($query,$x){
        if(trim($x) != ''){
            $query->where('sucursal_id', $x);
        }
    }
    function scopeCliente($query,$x){
        if(trim($x) != ''){
            $query->where('cliente_id', $x);
        }
    }
    function scopeUsuario($query,$x){
        if(trim($x) != ''){
            $query->where('usuario_id', $x);
        }
    }
}