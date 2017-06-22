<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'articulos';
    protected $fillable = [
        'nombre',
        'registro',
        'estado',
        'codigo',
        'categoria_articulo_id',
        'marca_id',
        'material_id',
        'medida_id',
        'costo',
        'precio1',
        'precio2',
        'precio3',
        'codigobarra',
        'stockmin'
    ];

    function categoria(){
    	return $this->belongsTo('App\CategoriaArticulo','categoria_articulo_id','id');
    }

    function marca(){
    	return $this->belongsTo('App\Marca','marca_id','id');
    }

    function material(){
    	return $this->belongsTo('App\Material','material_id','id');
    }

    function medida(){
    	return $this->belongsTo('App\Medida','medida_id','id');
    }

    function scopeArticulo($query,$name){
        if(trim($name) != ''){
            $query->where('nombre','like',"%$name%")
            ->orWhere('codigo','like',"%$name%");
        }
    }
    function  deleteOk(){
        /*$num = Inmueble::where('usuarios_id',$this->id)->count();
        $num+= Ciudad::where('usuarios_id',$this->id)->count();
        $num+= Zona::where('usuarios_id',$this->id)->count();
        $num+= Departamento::where('usuarios_id',$this->id)->count();
        $num+= Empresa::where('usuarios_id',$this->id)->count();
        $num+= Galeria::where('usuarios_id',$this->id)->count();
        $num+=Responsable::where('usuarios_id',$this->id)->count();
        $num+=TipOfertas::where('usuarios_id',$this->id)->count();
        $num+=TipInmuebles::where('usuarios_id',$this->id)->count();
        $num+=News::where('usuarios_id',$this->id)->count();
        if($num>0)
            return false;
        else*/
            return true;
    }

    function activo(){
        if($this->estado==1)
            return ['default','Activo'];
        else
            return ['danger','Inactivo'];
    }
}
