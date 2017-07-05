<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompraCredito extends Model
{
    protected $table =  'compras_creditos';
    protected $fillable = ['fecha','compra_id','abono'];
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
}
