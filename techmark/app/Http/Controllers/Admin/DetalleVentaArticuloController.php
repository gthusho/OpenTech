<?php

namespace App\Http\Controllers\Admin;

use App\Articulo;
use App\DetalleVentaArticulo;
use App\Sucursal;
use App\Tool;
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
            $this->datos['brand'] = Tool::brand('Listado de Ingresos ',route('egresos.articulos.index'),'Egresos Articulos');
            $this->datos['egresos'] = DetalleVentaArticulo::with('articulo','sucursal','almacen')
                ->fecha($request->get('fecha'))
                ->fecha($request->get('f'))
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
        $this->datos['articulos']=Articulo::orderBy('nombre')->pluck('nombre','id');
    }
    public function deleteItemsVentaArticulo($id)
    {
        if(Auth::user()->can('allow-delete')) {
            DetalleVentaArticulo::destroy($id);
            return redirect()->back();
            //return redirect()->route('admin.compra.create');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
