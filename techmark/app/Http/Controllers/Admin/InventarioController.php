<?php

namespace App\Http\Controllers\Admin;
use App\Articulo;
use App\CategoriaArticulo;
use App\CotizacionArticulo;
use App\ExistenciaArticulo;
use App\ExistenciaProducto;
use App\Http\Controllers\Controller;
use App\Marca;
use App\Producto;
use App\Sucursal;
use App\Talla;
use App\Tool;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class InventarioController extends Controller
{
    private  $datos = null;
    function articulos(Request $request){
        $this->datos['brand'] = Tool::brand('Stock Articulos',route('inventario.articulos'),'Inventario');
        $this->datos['articulos'] = ExistenciaArticulo::with('articulo','almacen','sucursal','categoria')
            ->sucursal($request->get('sucursal'))
            ->articulo($request->get('articulo'))
            ->orderBy('articulo_id','desc')
            ->paginate(50);
        $this->genDatos();
        return view('cpanel.admin.inventario.articulos.list',$this->datos);
    }
    function genDatos(){
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos{'atticuloss'}=[];

        foreach (Articulo::orderBy('nombre')->get() as $row)
            $this->datos['articuloss'][$row->id] = $row->codigo .' - '.$row->nombre;
    }
    function productos(Request $request){
        $this->datos['brand'] = Tool::brand('Stock Productos',route('inventario.productos'),'Inventario');
        $this->datos['productos'] = ExistenciaProducto::with('producto','talla','sucursal')
            ->sucursal($request->get('sucursal'))
            ->producto($request->get('producto'))
            ->talla($request->get('talla'))
            ->orderBy('producto_id','desc')
            ->paginate(50);
        $this->genDatosp();
        return view('cpanel.admin.inventario.productos.list',$this->datos);
    }
    function genDatosp(){
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['tallas']=Talla::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos{'productoss'}=[];

        foreach (Producto::where('estado',true)->orderBy('descripcion')->get() as $row)
            $this->datos['productoss'][$row->id] = $row->codigo .' - '.$row->descripcion;
    }
}
