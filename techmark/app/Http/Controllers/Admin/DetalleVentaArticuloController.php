<?php

namespace App\Http\Controllers\Admin;

use App\Articulo;
use App\DetalleVentaArticulo;
use App\IAManager;
use App\Sucursal;
use App\Tool;
use App\VentaArticulo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetalleVentaArticuloController extends Controller
{
    private  $datos = null;
    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Listado de Egresos ',route('egresos.articulos.index'),'Egresos Articulos');
            $this->datos['egresos'] = DetalleVentaArticulo::with('articulo','sucursal','almacen')
                ->where('sucursal_id','<>','')
                ->fecha($request->get('fecha'))
                ->sucursal($request->get('sucursal'))
                ->articulo($request->get('articulo'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.egarticulos.list')->with($this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
    function genDatos(){
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos{'articulos'}=[];

        foreach (Articulo::orderBy('nombre')->get() as $row)
            $this->datos['articulos'][$row->id] = $row->codigo .' - '.$row->nombre;
    }
    public function deleteItemsVentaArticulo($id)
    {
        if(Auth::user()->can('allow-delete')) {
            $detalle = DetalleVentaArticulo::find($id);
            $venta = VentaArticulo::find($detalle->venta_articulo_id);
            if($venta->estado=='t'){
                /*
               * reducimos de stock
               */
                $existencia = new IAManager($detalle->articulo_id, $detalle->sucursal_id, $detalle->almacen_id);
                $existencia->add($detalle->cantidad);
            }

            DetalleVentaArticulo::destroy($id);
            return redirect()->back();
            //return redirect()->route('admin.compra.create');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
