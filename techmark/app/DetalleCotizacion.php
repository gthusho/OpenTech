<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 04/07/2017
 * Time: 02:03 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class DetalleCotizacion extends Model
{
    protected $table = 'detalles_cotizaciones';
        protected $fillable = [
        'articulo_id','cantidad','precio','registro','usuario_id','sucursal_id','cotizacion_id'
    ];

    function articulo(){
        return $this->belongsTo('App\Articulo','articulo_id','id');
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function sucursal(){
        return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
    function cotizacionarticulo(){
        return $this->belongsTo('App\CotizacionArticulo','cotizacion_id','id');
    }
    public  function  setPrecioAttribute($value){
        if(!empty($value)){
            $this->attributes['precio']=\str_replace(",","",$value);
        }

    }
    public  function  setCantidadAttribute($value){
        if(!empty($value)){
            $this->attributes['cantidad']=\str_replace(",","",$value);
        }

    }




}