<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleMedida extends Model
{
    protected $table = 'detalle_medida';
    protected $fillable = [
        'usuario_id', 'ubicacion', 'descripcion',
        'alto', 'ancho', 'largo', 'registro', 'visita_cotizacion_id', 'cantidad', 'precio', 'estado'
    ];

    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }

    function visita(){
        return $this->belongsTo('App\VisitaCotizacion','visita_cotizacion_id','id');
    }

    function producto(){
        return $this->belongsTo('App\ProductoBase','producto_id','id');
    }

    function activo(){
        switch ($this->estado){
            case '1':{
                return ['default','Producido'];
            }
            case '0' :{
                return ['danger','En Espera'];
            }
            default: return ['inverse','error'];

        }
    }
}
