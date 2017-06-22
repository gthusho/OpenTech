<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agendas';
    protected  $fillable = [
      'inicio','fin','fecha','asunto','descripcion','ubicacion','planificado','categoria','archivo'
    ];
    function fechas(){
        return "del:  ".$this->inicio.' al: '.$this->fin;
    }
    function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }
    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('asunto','like',"%$name%");
        }
    }
    function getArchivo(){
        return url(\Config::get('upload.archivos').$this->archivo);
    }
}
