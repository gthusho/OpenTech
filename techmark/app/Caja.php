<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Caja extends Model
{
    protected $table = 'caja';
    protected $fillable = [
        'usuario_id','sucursal_id','apertura','cierre','registro','observaciones','fcierre','estado'
    ];

    public  function  setAperturaAttribute($value){
        if(!empty($value)){
            $this->attributes['apertura']=\str_replace(",","",$value);
        }

    }
    public  function  setCierreAttribute($value){
        if(!empty($value)){
            $this->attributes['cierre']=\str_replace(",","",$value);
        }

    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }

    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }

    function scopeFecha($query,$fecha){
        if(trim($fecha) != ''){
            $fecha2=$fecha." 23:59:59";
            $query->whereBetween('registro',[$fecha,$fecha2]);
        }
    }

    function scopeUsuario($query,$x){
        if(trim($x) != ''){
            $query->where('usuario_id', $x);
        }
    }

    function scopeSucursal($query,$x){
        if(trim($x) != ''){
            $query->where('sucursal_id', $x);
        }
    }

    function activo(){
        if($this->estado=='p')
            return ['default','Abierto'];
        else
            return ['danger','Cerrado'];
    }
    /*
     * metodos para obertener informacion para caja
     */
    function totalVentasArticulosByType($type){
        $fi= date('Y-m-d',strtotime($this->registro));
        $fc= $fi;

        if($this->fcierre!='' || $this->fcierre!=null)
            $fc= date('Y-m-d',strtotime($this->fcierre));

        $idSearch = VentaArticulo::where(\DB::raw("DATE(registro)"),'>=',$fi)
            ->where('usuario_id',$this->usuario_id)
            ->where(\DB::raw("DATE(registro)"),'<=',$fc)
            ->where('estado','t')
            ->where('tipo_pago',$type)->get()->lists('id')->toArray();

        if(count($idSearch)<=0)
            $idSearch = [0];

        $total = DetalleVentaArticulo::whereIn('venta_articulo_id',$idSearch)->sum('precio');

        if($total==0 || $total == null)
            return 0;
        else
            return $total;
    }
    function totalVentasArticulos(){
        $fi= date('Y-m-d',strtotime($this->registro));
        $fc= $fi;

        if($this->fcierre!='' || $this->fcierre!=null)
            $fc= date('Y-m-d',strtotime($this->fcierre));

        $idSearch = VentaArticulo::where(\DB::raw("DATE(registro)"),'>=',$fi)
            ->where('usuario_id',$this->usuario_id)
            ->where(\DB::raw("DATE(registro)"),'<=',$fc)
            ->where('estado','t')->get()->lists('id')->toArray();

        if(count($idSearch)<=0)
            $idSearch = [0];

        $total = DetalleVentaArticulo::whereIn('venta_articulo_id',$idSearch)->sum('precio');

        if($total==0 || $total == null)
            return 0;
        else
            return $total;
    }
    function totalIngresos(){
        $ingresosVentasArticulos = $this->totalVentasArticulos();
        $ingresosVentasProductos = 0;

    }
}
