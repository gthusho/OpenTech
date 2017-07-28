<?php

namespace App\Http\Controllers\Sucursal;
use App\Articulo;
use App\CategoriaArticulo;
use App\CotizacionArticulo;
use App\ExistenciaArticulo;
use App\Http\Controllers\Controller;
use App\Marca;
use App\Sucursal;
use App\Tool;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class InventarioController extends Controller
{
    private  $datos = null;
    private $permiso = 'inventario';
    function __construct()
    {
        $this->middleware('observador:'.$this->permiso);
    }

    function articulos(Request $request){
        $this->datos['brand'] = Tool::brand('Stock Articulos',route('s.inventario.articulos'),'Inventario');
        $this->datos['articulos'] = ExistenciaArticulo::with('articulo','almacen','sucursal','categoria')
            ->sucursal($request->get('sucursal'))
            ->articulo($request->get('articulo'))
            ->orderBy('articulo_id','desc')
            ->paginate(50);
        $this->genDatos();
        return view('cpanel.sucursal.inventario.articulos.list',$this->datos);
    }
    function genDatos(){
        $user=User::find(Auth::user()->id);
        $this->datos['sucursal']=$user->sucursal_id;
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
       $this->datos['articuloss']=Articulo::orderBy('nombre')->pluck('nombre','id');
    }
}