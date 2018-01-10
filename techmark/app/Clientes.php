<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 21/06/2017
 * Time: 11:32 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'razon_social', 'nit', 'telefono',
        'direccion',
        'email'
    ];
    function cotizacionarticulo(){
        return $this->hasMany('App\CotizacionArticulo','cliente_id','id');
    }
    function ventaarticulo(){
        return $this->hasMany('App\VentaArticulo','cliente_id','id');
    }
    function cotizacionproducto(){
        return $this->hasMany('App\CotizacionProducto','cliente_id','id');
    }
    function ventaproducto(){
        return $this->hasMany('App\VentaProducto','cliente_id','id');
    }
    function produccion(){
        return $this->hasMany('App\ProduccionCliente','cliente_id','id');
    }
    function visita(){
        return $this->hasMany('App\VisitaCotizacion','cliente_id','id');
    }
    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('razon_social','like',"%$name%")
                ->orwhere('nit','like',"%$name%");
        }
    }
    function scopeCliente($query,$name){
        if(trim($name) != ''){
            $query->where('razon_social','like',"%$name%")
                ->orwhere('nit','like',"%$name%");
        }
    }
    function scopeId($query,$x){
        if(trim($x) != ''){
            $query->where('id',$x);
        }
    }
    function  deleteOk(){
        /*$num = Inmueble::where('usuarios_id',$this->id)->count();
        if($num>0)
            return false;
        else*/
        return true;
    }
    function cantVenArt(){
        $num=0;
        foreach ($this->ventaarticulo as $fila){
            if($fila->estado != 'c')
                $num+=$fila->totalCantidad();
        }
        return $num;
    }
    function totVenArt(){
        $num=0;
        foreach ($this->ventaarticulo as $fila){
            if($fila->estado != 'c')
                $num+=$fila->totalPrecio();
        }
        return $num;
    }
    function cantCotArt(){
        $num=0;
        foreach ($this->cotizacionarticulo as $fila){
            $num+=$fila->totalCantidad();
        }
        return $num;
    }
    function totCotArt(){
        $num=0;
        foreach ($this->cotizacionarticulo as $fila){
            $num+=$fila->totalPrecio();
        }
        return $num;
    }
    function cantVenPrd(){
        $num=0;
        foreach ($this->ventaproducto as $fila){
            if($fila->estado != 'c')
                $num+=$fila->totalCantidad();
        }
        return $num;
    }
    function totVenPrd(){
        $num=0;
        foreach ($this->ventaproducto as $fila){
            if($fila->estado != 'c')
                $num+=$fila->totalPrecio();
        }
        return $num;
    }
    function cantCotPrd(){
        $num=0;
        foreach ($this->cotizacionproducto as $fila){
            $num+=$fila->totalCantidad();
        }
        return $num;
    }
    function totCotPrd(){
        $num=0;
        foreach ($this->cotizacionproducto as $fila){
            $num+=$fila->totalPrecio();
        }
        return $num;
    }
    function cantProd(){
        $num=0;
        foreach ($this->produccion as $fila){
            $num+=$fila->totalCantidad();
        }
        return $num;
    }
    function totProd(){
        $num=0;
        $num=ProduccionCliente::where('cliente_id',$this->id)->sum('precio');
        return $num;
    }
    function cantMed(){
        $num=0;
        foreach ($this->visita as $fila){
            $num+=$fila->cantMedidos();
        }
        return $num;
    }
    function cantPrd(){
        $num=0;
        foreach ($this->visita as $fila){
            $num+=$fila->cantProducidos();
        }
        return $num;
    }
    function totReal(){
        return $this->totVenArt() + $this->totProd() + $this->totVenPrd();
    }

    function totImg(){
        return $this->totCotArt() + $this->totCotPrd();
    }

    function cantVis(){
        return VisitaCotizacion::where('cliente_id',$this->id)->count();
    }
}