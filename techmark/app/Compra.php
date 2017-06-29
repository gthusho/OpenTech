<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    function scopeFecha($query,$fecha){
        if(trim($fecha) != ''){
            $query->where('fecha',$fecha);
        }
    }
}
