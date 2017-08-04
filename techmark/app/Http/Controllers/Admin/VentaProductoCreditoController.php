<?php

namespace App\Http\Controllers\Admin;
use App\Almacen;
use App\Articulo;
use App\Cart;
use App\Compra;
use App\CompraCredito;
use App\Http\Controllers\Controller;
use App\Ingresos;
use App\Proveedor;
use App\Rol;
use App\Sucursal;
use App\User;
use App\VentaCreditoProducto;
use App\VentaProducto;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VentaProductoCreditoController extends Controller
{

    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Ventas Productos al Credito Registradas',route('admin.ventas.creditos.productos.index'),'Ventas  al Credito');
            $this->datos['ventas'] = VentaProducto::fecha($request->get('fecha'))
                ->where('estado','t')->where('tipo_pago','Credito')
                ->codigo($request->get('s'))
                ->sucursal($request->get('sucursal'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.venta_producto_credito.list',$this->datos);
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }



    }
    function genDatos(){
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['proveedores']=Proveedor::where('estado',true)->orderBy('razon_social')->pluck('razon_social','id');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){

           $abono = new VentaCreditoProducto($request->all());
           $abono->usuario_id = Auth::user()->id;
            $abono->save();
            return redirect()->back();
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');

    }


    public function show($id)
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Pago Venta Credito',route('admin.ventas.creditos.productos.index'),'Venta Producto al Credito');

            $this->datos['venta'] = VentaProducto::find($id);

            return view('cpanel.admin.venta_producto_credito.edit',$this->datos);
        }


        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }
    public function destroy($id)
    {

        if(Auth::user()->can('allow-delete')) {
            VentaCreditoProducto::destroy($id);
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }

}
