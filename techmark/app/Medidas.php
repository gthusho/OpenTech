<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 21/06/2017
 * Time: 11:39 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Medidas extends Model
{
    protected $table = 'medidas';
    protected $fillable = [
        'registro', 'cliente_id'
    ];

    function cliente(){
        return $this->belongsTo('App\Clientes', 'cliente_id','id');
    }

    function detalle(){
        return $this->hasMany('App\DetalleMedida','medida_id','id');
    }

    function scopeCliente($query,$name){
        if(trim($name) != ''){
            $query->where('cliente_id',$name);
        }
    }

    function cantProducidos(){
        return DetalleMedida::where('medida_id',$this->id)->where('estado',true)->count();
    }

    function cantMedidos(){
        return DetalleMedida::where('medida_id',$this->id)->where('estado',false)->count();
    }
}