<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 21/06/2017
 * Time: 11:39 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class VisitaCotizacion extends Model
{
    protected $table = 'visita_cotizacion';
    protected $fillable = [
        'registro', 'cliente_id', 'fecha', 'hora', 'usuario_id', 'x', 'y', 'direccion', 'zona', 'barrio', 'observacion'
    ];

    function cliente(){
        return $this->belongsTo('App\Clientes', 'cliente_id','id');
    }

    function detalle(){
        return $this->hasMany('App\DetalleMedida','visita_cotizacion_id','id');
    }

    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }

    function scopeCliente($query,$name){
        if(trim($name) != ''){
            $query->where('cliente_id',$name);
        }
    }

    function scopeDireccion($query,$type,$x){
        if(trim($x) != ''){
            switch ($type) {
                case 0:
                    $query->where('direccion','like',"%$x%");
                    break;
                case 1:
                    $query->where('zona', 'like',"%$x%");
                    break;
                case 2:
                    $query->where('barrio', 'like',"%$x%");
                    break;
                default:
                    break;
            }
        }
    }

    function scopeFecha($query,$fecha){
        if(trim($fecha) != ''){
            $date = Tool::getArrayDate($fecha);
            $query->where(\DB::raw('fecha'),'>=',$date[0])->where(\DB::raw('fecha'),'<=',$date[1]);
        }
    }

    function cantProducidos(){
        return DetalleMedida::where('visita_cotizacion_id',$this->id)->where('estado',true)->count();
    }

    function cantMedidos(){
        return DetalleMedida::where('visita_cotizacion_id',$this->id)->where('estado',false)->count();
    }
}