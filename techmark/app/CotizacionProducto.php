<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CotizacionProducto extends Model
{
    protected $table = 'cotizaciones_productos';
    protected $fillable = [
        'registro','usuario_id','cliente_id','sucursal_id','fvalides'
    ];



    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function almacen(){
        return $this->belongsTo('App\Almacen','almacen_id','id');
    }
    function cliente(){
        return $this->belongsTo('App\Clientes','cliente_id','id');
    }
    function detalle(){
        return $this->hasMany('App\DetalleCotizacionProducto','cotizacion_producto_id','id');
    }
    function totalPrecio(){
        $total = DetalleCotizacionProducto::where('cotizacion_producto_id',$this->id)->sum('precio');
        if($total==null || $total=='')
            return '0' ;
        else
            return $total;
    }
    function totalCantidad(){
        $total =  DetalleCotizacionProducto::where('cotizacion_producto_id',$this->id)->count();
        return $total;
    }
    function getCode(){
        return 'CO'.sprintf("%06d", $this->id);
    }
    function scopeCodigo($query,$co){
        if(trim($co) != ''){
            $pre = str_replace('CO','',$co);
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
    function scopeFecha($query,$fecha){
        if(trim($fecha) != ''){
            $date = Tool::getArrayDate($fecha);
            $query->where(\DB::raw('DATE(registro)'),'>=',$date[0])->where(\DB::raw('DATE(registro)'),'<=',$date[1]);

        }
    }
    function scopeEstado($query,$x){
        if(trim($x) != ''){
            $query->where('estado', $x);
        }
    }
    function scopeUsuario($query,$x){
        if(trim($x) != ''){
            $query->where('usuario_id', $x);
        }
    }
    function getDestino(){
        $det=DetalleCotizacionProducto::where('cotizacion_producto_id',$this->id);
        $mensaje='';
        foreach (DetalleCotizacionProducto::where('cotizacion_producto_id',$this->id)->paginate(200) as $row){
            if($row->descripcion!='' || $row->descripcion!=null)
                $mensaje=$mensaje.$row->cantidad.' '.$row->productobase->descripcion.' '.$row->talla->nombre.' de '.$row->material->nombre.' '.$row->descripcion."\n";
            else
                $mensaje=$mensaje.$row->cantidad.' '.$row->productobase->descripcion.' '.$row->talla->nombre.' de '.$row->material->nombre."\n";
        }
        return $mensaje;
    }

    function estado(){
        $dateFinish = Carbon::createFromDate(date('Y',strtotime($this->fvalides)),date('m',strtotime($this->fvalides)),date('d',strtotime($this->fvalides)));
        $dateCurrent = Carbon::now('America/La_Paz');
        if($this->estado=='a')
            return ['warning','Adjudicado'];
        else {
            if ($dateCurrent->lessThanOrEqualTo($dateFinish))
                return ['default', 'Activo'];
            else
                return ['danger','Plazo terminado'];
        }
    }
}
