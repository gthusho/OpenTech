<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $fillable = [
        'sucursal_id','almacen_id','proveedor_id','fecha','codigo','tipo_compra','nfactura'
    ];

    function ingresos(){
        return $this->belongsTo('App\Ingresos','id','compra_id');
    }
    function articulos(){
        return $this->hasMany('App\Ingresos','compra_id','id');
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function almacen(){
        return $this->belongsTo('App\Almacen','almacen_id','id');
    }
    function proveedor(){
        return $this->belongsTo('App\Proveedor','proveedor_id','id');
    }
    function totalCosto(){
        $total = Ingresos::where('compra_id',$this->id)->sum('costo');
       if($total==null || $total=='')
           return '0' ;
        else
            return $total;
    }
    function pagos(){
        return $this->hasMany('App\CompraCredito','compra_id','id');
    }
    function totalCantidad(){
        $total =  Ingresos::where('compra_id',$this->id)->count();
        return $total;
    }
    function getCode(){
        return 'C'.sprintf("%06d", $this->id);
    }
        function scopeCompra($query,$fecha){
        if(trim($fecha) != ''){
            $date = Tool::getArrayDate($fecha);
            $query->where(\DB::raw('DATE(fecha)'),'>=',$date[0])->where(\DB::raw('DATE(fecha)'),'<=',$date[1]);

        }
    }
    function scopeFecha($query,$fecha){
        if(trim($fecha) != ''){
            $date = Tool::getArrayDate($fecha);
            $query->where(\DB::raw('DATE(fecha)'),'>=',$date[0])->where(\DB::raw('DATE(fecha)'),'<=',$date[1]);

        }
    }
    function scopeCodigo($query,$c){
        if(trim($c) != ''){
            $pre = str_replace('C','',$c);
            $query->where('id',$pre);
        }
    }
    function scopeProveedor($query,$x){
        if(trim($x) != ''){
            $query->where('proveedor_id',$x);
        }
    }
    function scopeSucursal($query,$x){
        if(trim($x) != ''){
            $query->where('sucursal_id', $x);
        }
    }

    /*
     * MEtodos para compra al credito
     */
    function  getTotalAbonos(){
       $total = CompraCredito::where('compra_id',$this->id)->sum('abono');
       if($total == '' || $total ==null){
           return 0;
       }else{
           return $total;

       }
    }
    function getTotalDeuda(){
       return $this->totalCosto() - $this->getTotalAbonos();
    }
}
