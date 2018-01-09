<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'unidad_id',
        'costo',
        'precio1',
        'precio2',
        'precio3',
        'precio4',
        'precio5',
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
    function ingreso(){
        return $this->belongsTo('App\Ingreso','id','articulo_id');
    }
    function detalleventaarticulo(){
        return $this->belongsTo('App\DetalleVentaArticulo','id','articulo_id');
    }
    function existenciaarticulo(){
        return $this->belongsTo('App\ExistenciaArticulo','id','articulo_id');
    }

    function marca(){
    	return $this->belongsTo('App\Marca','marca_id','id');
    }

    function material(){
    	return $this->belongsTo('App\Material','material_id','id');
    }

    function medida(){
    	return $this->belongsTo('App\Unidad','unidad_id','id');
    }

    function scopeCategoria($query,$x){
        if(trim($x) != ''){
            $query->where('categoria_articulo_id', $x);

        }
    }
    function getPrecio($tipo){
        switch ($tipo){
            case 'P1':{
                return $this->precio1;
            }
            case 'P2':{
                return $this->precio2;
            }
            case 'P3':{
                return $this->precio3;
            }
            case 'P4':{
                return $this->precio4;
            }
            case 'P5':{
                return $this->precio5;
            }
            default: return 0;
        }
    }
    function scopeMarca($query,$x){
        if(trim($x) != ''){
            $query->where('marca_id', $x);
        }
    }
    function scopeMedida($query,$x){
        if(trim($x) != ''){
            $query->where('unidad_id', $x);
        }
    }
    function scopeMaterial($query,$x){
        if(trim($x) != ''){
            $query->where('material_id', $x);
        }
    }
    function scopeTipo($query,$tipo,$s){
        if(trim($s) != ''){
            switch ($tipo){
                case '0':{
                    $query->where('nombre', 'like', "%$s%");
                    break;
                }
                case '1':{
                    $query->where('codigo', 'like', "%$s%");
                    break;
                }
                case '2':{
                    $query->where('codigobarra', 'like', "%$s%");
                    break;
                }
                default: break;
            }

        }
    }
   /* function scopeArticulo($query,$name){
        if(trim($name) != ''){
            $id=Ingresos::articulo($name)->pluck('id');
            $query->where('articulo_id',$name);
        }
    }*/
    function scopeArticulo($query,$name){
        if(trim($name) != ''){
            $query->where('nombre', 'like', "%$name%");
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
    function getStockAll(){
        $cantidad = 0;
        if(Auth::user()->rol_id==1){
            $cantidad =  ExistenciaArticulo::where('articulo_id',$this->id)->sum('cantidad');
            if($cantidad!='')
                return $cantidad;
            else
                return 0;
        }else{
            $cantidad =  ExistenciaArticulo::where('articulo_id',$this->id)->where('sucursal_id',Auth::user()->sucursal_id)->sum('cantidad');
            if($cantidad!='')
                return $cantidad;
            else
                return 0;
        }



    }
    function activo(){
        if($this->estado==1)
            return ['default','Activo'];
        else
            return ['danger','Inactivo'];
    }
//    function codigoL(){
//         return str_pad(this.co, 10, "-=", STR_PAD_LEFT)
//    }
}
