<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProduccionCliente extends Model
{
    protected $table = 'producciones_clientes';
    protected $fillable = [
        'destino','fecha','registro','trabajador_id','usuario_id','inicio','fin','sucursal_id','estado',
        'cliente_id','precio','adelanto'
    ];

    function detalle()
    {
        return $this->hasMany('App\DetProduccionCliente', 'produccion_cliente_id', 'id');
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
    function cliente()
    {
        return $this->belongsTo('App\Clientes', 'cliente_id', 'id');
    }
    function totalPrecio(){
        $total = DetProduccionCliente::where('produccion_cliente_id',$this->id)->sum('precio');
        if($total==null || $total=='')
            return '0' ;
        else
            if($this->estado=='c')
                return $total*-1;
            else
                return $total;
    }
    function totalCantidad(){
        $total =  DetProduccionCliente::where('produccion_cliente_id',$this->id)->count();
        return $total;
    }
    function getCode(){
        return 'PC'.sprintf("%06d", $this->id);
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
    function scopeCliente($query,$x){
        if(trim($x) != ''){
            $query->where('cliente_id', $x);
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
    function checkState(){
        $state = '';
        $fechas=explode('-',$this->fecha);
        $inicio=$fechas[0];
        $fin=$fechas[1];
        $dateFinish = Carbon::createFromDate(date('Y',strtotime($fin)),date('m',strtotime($fin)),date('d',strtotime($fin)));
        $dateCurrent = Carbon::now('America/La_Paz');
        if($dateCurrent->lessThanOrEqualTo($dateFinish)){
          return  $state = ['EN PRODUCCION','p','inverse'];
        }else{
            if ($this->terminado==1){
                if($this->estado=='c'){
                    return $state = ['CANCELADA','c','warning'];
                }else{
                    return $state = ['ENTREGADO','t','success'];
                }
            }else{
                return  $state = ['PLAZO TERMINADO','e','warning'];
            }
        }
    }
    public  function  setPrecioAttribute($value){
        if(!empty($value)){
            $this->attributes['precio']=\str_replace(",","",$value);
        }

    }
    public  function  setAdelandoAttribute($value){
        if(!empty($value)){
            $this->attributes['adelando']=\str_replace(",","",$value);
        }

    }
}
