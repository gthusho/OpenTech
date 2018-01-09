<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaProducto extends Model
{
    protected $table = 'ventas_productos';
    protected $fillable = [
      'cliente_id','observaciones','usuario_id','sucursal_id','tipo_pago','abono'
    ];
    function detalleventas(){
        return $this->hasMany('App\DetalleVentaProducto','venta_producto_id','id');
    }
    function pagos(){
        return $this->hasMany('App\VentaCreditoProducto','venta_producto_id','id');
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
        $total = DetalleVentaProducto::where('venta_producto_id',$this->id)->sum('precio');
        if($total==null || $total=='')
            return '0' ;
        else
            return $total;
    }
    function totalCantidad(){
        $total =  DetalleVentaProducto::where('venta_producto_id',$this->id)->count();
        return $total;
    }
    function getCode(){
        return 'VP-'.sprintf("%06d", $this->id);
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
    function scopeCodigo($query,$v){
        if(trim($v) != ''){
            $pre = str_replace('VP-','',$v);
            $query->where('id',$pre);
        }
    }
    function scopeCliente($query,$x){
        if(trim($x) != ''){
            $query->where('cliente_id', $x);
        }
    }
    function  getTotalAbonos(){
        $total = VentaCreditoProducto::where('venta_producto_id',$this->id)->sum('abono') ;
        if($total == '' || $total ==null){
            return 0;
        }else{
            return $total;

        }
    }
    function scopeSucursal($query,$x){
        if(trim($x) != ''){
            $query->where('sucursal_id', $x);
        }
    }
    function getTotalDeuda(){
        return $this->totalPrecio() - $this->getTotalAbonos() ;
    }
    function totalVenta($query,$fecha){
        $total = DetalleVentaProducto::where('DetalleVentaProducto',$this->id)->where('registro',$this->caja->registro)->sum(totalPrecio());
        if($total==null || $total=='')
            return '0' ;
        else
            return $total;
    }

    function activo(){
        switch ($this->estado){
            case '1':{
                return ['default','Act
                ivo'];
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
