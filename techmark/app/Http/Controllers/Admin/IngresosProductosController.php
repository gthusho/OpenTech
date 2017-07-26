<?php

namespace App\Http\Controllers\Admin;
use App\Articulo;
use App\Compra;
use App\Http\Controllers\Controller;
use App\IAManager;
use App\Ingresos;
use App\IngresosProducto;
use App\Produccion;
use App\Rol;
use App\Sucursal;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class IngresosProductosController extends Controller
{

    private  $datos = null;
    private  $ingreso = null;


    public function index(Request $request)
    {

//        if(Auth::user()->can('allow-read')){
//            $this->datos['brand'] = Tool::brand('Listado de Ingresos ',route('ingresos.articulos.index'),'Ingresos Articulos');
//            $this->datos['ingresos'] = Ingresos::with('articulo','sucursal','compra','almacen')
//                ->compra($request->get('compra'))
//                ->sucursal($request->get('sucursal'))
//                ->articulo($request->get('articulo'))
//                ->orderBy('id','desc')
//                ->paginate();
//            $this->genDatos();
//            return view('cpanel.admin.inarticulos.list')->with($this->datos);
//        }
//
//        \Session::flash('message','No tienes Permiso para visualizar informacion ');
//        return redirect('dashboard');

    }

    private $produccion =  null;


    function create(Request $request){
        $this->produccion = Produccion::find($request->get('idProducction'));
        /*
         * previa para verificar :
         * si existe
         * si aun no ingreso a inventario
         * si no es un falso verdadero
         */
        if (!Tool::existe($this->produccion) || $this->produccion->terminado ==1 || $this->produccion->estado=='p' ){

            return redirect()->route('admin.ingresos.productos.index');
        }
        /*
         * comenzamos
         */

        $this->datos['brand'] = Tool::brand('',route('ingresos.articulos.index'),'Ingresos productos');
        $this->datos['produccion'] = $this->produccion;
        return view('cpanel.admin.ingresosproductos.registro',$this->datos);



    }


}
