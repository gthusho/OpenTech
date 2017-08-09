<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 03/08/2017
 * Time: 02:44 PM
 */

namespace App\Http\Controllers\Sucursal;


use App\DetalleVentaProducto;
use App\Http\Controllers\Controller;
use App\Articulo;
use App\DetalleVentaArticulo;
use App\IAManager;
use App\Producto;
use App\Sucursal;
use App\Talla;
use App\Tool;
use App\VentaArticulo;
use App\VentaProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DetalleVentaProductoController extends Controller
{
    private  $datos = null;
    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Listado de Egresos ',route('s.egresos.productos.index'),'Egresos Productos');
            $this->datos['egresos'] = DetalleVentaProducto::with('producto','sucursal','ventaproducto','talla')
                ->where('sucursal_id','<>','')
                ->fecha($request->get('fecha'))
                ->sucursal(Auth::user()->sucursal_id)
                ->producto($request->get('producto'))
                ->talla($request->get('talla'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.sucursal.egproductos.list')->with($this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
    function genDatos(){
        $this->datos['productos']=Producto::where('estado',true)->orderBy('descripcion')->pluck('descripcion','id');
        $this->datos['tallas']=Talla::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
    }
    public function deleteItemsVentaProducto($id)
    {
        if(Auth::user()->can('allow-delete')) {
            $detalle = DetalleVentaProducto::find($id);
            $venta = VentaProducto::find($detalle->venta_producto_id);
            if($venta->estado=='t'){
                /*
               * reducimos de stock
               */
                $existencia = new IAManager($detalle->producto_id, $detalle->sucursal_id, $detalle->almacen_id);
                $existencia->add($detalle->cantidad);
            }

            DetalleVentaProducto::destroy($id);
            return redirect()->back();
            //return redirect()->route('admin.compra.create');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}