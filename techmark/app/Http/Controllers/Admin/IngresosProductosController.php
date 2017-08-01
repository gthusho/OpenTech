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

    private $produccion =  null;

    function setProducto($sucursal_id,$producto_id,$talla_id, $cantidad){
        $ingreso = null;
        $query = IngresosProducto::where('produccion_id',$this->produccion->id)
                                    ->where('producto_id',$producto_id)
                                    ->where('talla_id',$talla_id)
                                    ->where('sucursal_id',$sucursal_id)
                                    ->get();
        if(Tool::existe($query)){
            $ingreso = $query->first();
            /*
            * ingreso items a existencia una vez terminado la compra
             */
            if ($this->produccion->estado=='t'){
//                $existencia = new IAManager($articulo->articulo_id, $this->compra->sucursal_id, $this->compra->almacen_id);
//                $existencia->UpdatePurchase($articulo->cantidad,$cantidad);
            }
            $ingreso->cantidad = $cantidad;
            $ingreso->save();
        }else{
            $ingreso = new  IngresosProducto();
            $ingreso->cantidad = $cantidad;
            $ingreso->producto_id = $producto_id;
            $ingreso->talla_id =  $talla_id;
            $ingreso->produccion_id =  $this->produccion->id;
            $ingreso->usuario_id =  Auth::user()->id;
            $ingreso->sucursal_id =  $sucursal_id;
            if ($this->produccion->estado=='t'){
//                $existencia = new IAManager($articulo->articulo_id, $this->compra->sucursal_id, $this->compra->almacen_id);
//                $existencia->add($cantidad);
            }
            $ingreso->save();
        }
    }

    function create(Request $request){
        $this->produccion = Produccion::find($request->get('idProducction'));
        /*
         * previa para verificar :
         * si existe
         * si aun no ingreso a inventario
         * si no es un falso verdadero
         */
        if (!Tool::existe($this->produccion) || $this->produccion->terminado ==1 || $this->produccion->estado=='p' ){

            return redirect()->route('admin.ingresar.productos.index');
        }
        /*
         * comenzamos
         */
        $this->datos['brand'] = Tool::brand('Ingresar Productos',route('admin.produccion.index'),'Producciones');
        $this->datos['produccion'] = $this->produccion;
        return view('cpanel.admin.ingresosproductos.registro',$this->datos);
    }
    function store(Request $request){
        $this->produccion = Produccion::find($request->get('produccion_id'));
        $this->setProducto($request->get('sucursal_id'), $request->get('producto_id'), $request->get('talla_id'), $request->get('xCantidad'));
        return redirect()->back();
    }
    function workProduccion($id,$action){ //cancelamos la produccion
        $this->produccion = Produccion::find($id);
        $this->produccion->terminado = 1;
        if($action=='c'){
            $this->produccion->estado = 'c';
            $this->changeState($this->produccion->id, 'c');
            \Session::flash('message','La produccion '.$this->produccion->getCode().' fue cancelada');

        }else{
            $this->produccion->estado = 't';
            $this->changeState($this->produccion->id, 't');
            \Session::flash('message','La produccion '.$this->produccion->getCode().' Ingreso a Inventario');

        }
        $this->produccion->save();
        return redirect()->route('admin.produccion.index');
    }
    //cambiamos el estado de ingresos_produccion
    function changeState($produccion_id,$estado){
        \DB::table('ingresos_productos')
            ->where('produccion_id', $produccion_id)
            ->update(['estado' => $estado]);
    }

    function edit($id){
        dd("hola");

    }



    public function destroy($id)/// eliminamos items de ingresos produccion
    {

        if(Auth::user()->can('allow-delete')) {
            IngresosProducto::destroy($id);
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
