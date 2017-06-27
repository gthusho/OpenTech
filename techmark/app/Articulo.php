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
    public  function  setCostoAttribute($value){
        if(!empty($value)){
            $this->attributes['costo']=\str_replace(",","",$value);
        }

    }
    public  function  setPrecio1Attribute($value){
        if(!empty($value)){
            $this->attributes['precio1']=\str_replace(",","",$value);
        }

    }
    public  function  setPrecio2Attribute($value){
        if(!empty($value)){
            $this->attributes['precio2']=\str_replace(",","",$value);
        }

    }
    public  function  setPrecio3Attribute($value){
        if(!empty($value)){
            $this->attributes['precio3']=\str_replace(",","",$value);
        }

    }
    public  function  setStockminAttribute($value){
        if(!empty($value)){
            $this->attributes['stockmin']=\str_replace(",","",$value);
        }

    }
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

    function scopeArticulo($query,$name,$buscar){
        if(trim($name) != ''){
            if($buscar==1) {
                $query->where('nombre', 'like', "%$name%")
                    ->orWhere('codigo', 'like', "%$name%");
            }
            else{
                if($buscar==2){
                    $id=CategoriaArticulo::categoria($name)->pluck('id');
                    $query->whereIn('categoria_articulo_id',$id);
                }
                else{
                    if($buscar==3){
                        $id=Marca::marca($name)->pluck('id');
                        $query->whereIn('marca_id',$id);
                    }
                    else{
                        if($buscar==4){
                            $id=Material::material($name)->pluck('id');
                            $query->whereIn('material_id',$id);
                        }
                        else{
                            $id=Medida::medida($name)->pluck('id');
                            $query->whereIn('medida_id',$id);
                        }
                    }
                }
            }
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
