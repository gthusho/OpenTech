<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Client;

class VentaArticulo extends Model
{
    protected $table = 'ventas_articulos';
    protected $fillable = [
        'cliente_id','registro','observaciones','estado','usuario_id','tipo_pago','sucursal_id','almacen_id','abono'
    ];



    function detalleventas(){
        return $this->hasMany('App\DetalleVentaArticulo','venta_articulo_id','id');
    }
    function pagos(){
        return $this->hasMany('App\VentaCreditoArticulo','venta_articulo_id','id');
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
    function almacen(){
        return $this->belongsTo('App\Almacen','almacen_id','id');
    }
    function totalPrecio(){
        $total = DetalleVentaArticulo::where('venta_articulo_id',$this->id)->sum('precio');
        if($total==null || $total=='')
            return '0' ;
        else
            return $total;
    }
    function totalCantidad(){
        $total =  DetalleVentaArticulo::where('venta_articulo_id',$this->id)->count();
        return $total;
    }
    function getCode(){
        return 'V-'.sprintf("%06d", $this->id);
    }
    function scopeFecha($query,$fecha){
        if(trim($fecha) != ''){
            $date = Tool::getArrayDate($fecha);
            $query->where(\DB::raw('DATE(registro)'),'>=',$date[0])->where(\DB::raw('DATE(registro)'),'<=',$date[1]);
        }
    }
    function scopeCodigo($query,$v){
        if(trim($v) != ''){
            $pre = str_replace('V-','',$v);
            $query->where('id',$pre);
        }
    }
    function scopeCliente($query,$x){
        if(trim($x) != ''){
            $query->where('cliente_id', $x);
        }
    }
    function  getTotalAbonos(){
        $total = VentaCreditoArticulo::where('venta_articulo_id',$this->id)->sum('abono');
        if($total == '' || $total ==null){
            return 0 + $this->abono;
        }else{
            return $total + $this->abono;

        }
    }
    function scopeSucursal($query,$x){
        if(trim($x) != ''){
            $query->where('sucursal_id', $x);
        }
    }
    function getTotalDeuda(){
        return $this->totalPrecio() - $this->getTotalAbonos();
    }
    function totalVenta($query,$fecha){
        $total = DetalleVentaArticulo::where('venta_articulo_id',$this->id)->where('registro',$this->caja->registro)->sum(totalPrecio());
        if($total==null || $total=='')
            return '0' ;
        else
            return $total;
    }

    function activo(){
        switch ($this->estado){
            case '1':{
                return ['default','Activo'];
            }
            case '0' :{
                return ['danger','Inactivo'];
            }
            default: return ['inverse','error'];
        }
    }

    function scopeUsuario($query,$x){
        if(trim($x) != ''){
            $query->where('usuario_id', $x);
        }
    }

}
