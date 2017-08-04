<?php

namespace App\Http\Controllers\Sucursal;
use App\Articulo;
use App\Compra;
use App\Http\Controllers\Controller;
use App\IAManager;
use App\Ingresos;
use App\IngresosProducto;
use App\IPManager;
use App\Produccion;
use App\Producto;
use App\Rol;
use App\Sucursal;
use App\Talla;
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
            $this->datos['brand'] = Tool::brand('Listado de Ingresos ',route('s.ingresos.productos.index'),'Ingresos Productos');
            $this->datos['ingresos'] = IngresosProducto::with('producto','sucursal','produccion','talla')
                ->fecha($request->get('fecha'))
                ->sucursal(Auth::user()->sucursal_id)
                ->producto($request->get('producto'))
                ->talla($request->get('talla'))
                    ->where('estado','t')
                ->orderBy('id','desc')
                ->paginate();
            $this->datos['productos']=Producto::where('estado',true)->orderBy('descripcion')->pluck('descripcion','id');
            $this->datos['tallas']=Talla::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
            return view('cpanel.sucursal.inproductos.list')->with($this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
}
