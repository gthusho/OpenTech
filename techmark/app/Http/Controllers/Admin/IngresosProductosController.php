<?php

namespace App\Http\Controllers\Admin;
use App\Articulo;
use App\Compra;
use App\Http\Controllers\Controller;
use App\IAManager;
use App\Ingresos;
use App\IngresosProducto;
use App\IPManager;
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

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Listado de Ingresos ',route('ingresos.productos.index'),'Ingresos Productos');
            $this->datos['ingresos'] = IngresosProducto::with('producto','sucursal','produccion','talla')
//                ->fecha($request->get('fecha'))
//                ->sucursal($request->get('sucursal'))
//                ->articulo($request->get('articulo'))
                    ->where('estado','t')
                ->orderBy('id','desc')
                ->paginate();
            $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
            return view('cpanel.admin.inproductos.list')->with($this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
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
            if ($this->produccion->terminado==1){
                $existencia = new IPManager($ingreso->producto_id, $ingreso->talla_id, $ingreso->sucursal_id);
                $existencia->UpdatePurchase($ingreso->cantidad,$cantidad);
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
            if ($this->produccion->terminado==1){
                $ingreso->estado = 't';
                $existencia = new IPManager($ingreso->producto_id, $ingreso->talla_id, $ingreso->sucursal_id);
                $existencia->add($cantidad);
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

            return redirect()->route('admin.produccion.index');
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
        $estado_anterior = $this->produccion->terminado;
        $this->produccion->terminado = 1;
        if($action=='c'){
            $this->produccion->estado = 'c';
            \Session::flash('message','La produccion '.$this->produccion->getCode().' fue cancelada');


            foreach ($this->produccion->productos_terminados as $row){
                if($row->estado=='t'){
                $existencia = new IPManager($row->producto->id,$row->talla->id, $row->sucursal->id);
                    $existencia->down($row->cantidad);
                }
            }
            $this->changeState($this->produccion->id, 'c');


        }else{
            $this->produccion->estado = 't';
            foreach ($this->produccion->productos_terminados as $row){
                if($row->estado=='p' && $this->produccion->estado=='t' && $this->produccion->terminado ==1){
                    $existencia = new IPManager($row->producto->id,$row->talla->id, $row->sucursal->id);
                    $existencia->add($row->cantidad);
                }
            }
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
        $this->produccion = Produccion::find($id);
        /*
         * previa para verificar :
         * si existe
         * si aun no ingreso a inventario
         * si no es un falso verdadero
         */
        if (Tool::existe($this->produccion) && $this->produccion->terminado ==1 && $this->produccion->estado=='t' ){
            $this->datos['brand'] = Tool::brand('Editar Items Produccion',route('admin.produccion.index'),'Producciones');
            $this->datos['produccion'] = $this->produccion;
            return view('cpanel.admin.ingresosproductos.edit',$this->datos);
        }else{
            return redirect()->route('admin.produccion.index');
        }

    }
    function update($id,Request $request){
        $this->produccion = Produccion::find($id);
        $this->setProducto($request->get('sucursal_id'), $request->get('producto_id'), $request->get('talla_id'), $request->get('xCantidad'));
        return redirect()->back();
    }
    function changeStateP($id){
        $this->produccion = Produccion::find($id);
        $this->produccion->estado = 't';
        $this->produccion->terminado = 0;
        $this->produccion->save();
        $this->changeState($this->produccion->id, 'p');
        \Session::flash('message','Se habilito nuevamente la producción '.$this->produccion->getCode());
        return redirect()->back();
    }

    public function destroy($id)/// eliminamos items de ingresos produccion
    {

        if(Auth::user()->can('allow-delete')) {
           $ingreso = IngresosProducto::find($id);

            if($ingreso->estado =='t'){
                $existencia = new IPManager($ingreso->producto_id,$ingreso->talla_id, $ingreso->sucursal_id);
                $existencia->down($ingreso->cantidad);
            }
            IngresosProducto::destroy($id);
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
