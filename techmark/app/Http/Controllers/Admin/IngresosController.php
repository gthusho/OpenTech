<?php

namespace App\Http\Controllers\Admin;
use App\Articulo;
use App\Compra;
use App\Http\Controllers\Controller;
use App\IAManager;
use App\Ingresos;
use App\Rol;
use App\Sucursal;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class IngresosController extends Controller
{

    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Listado de Ingresos ',route('ingresos.articulos.index'),'Ingresos Articulos');
            $this->datos['ingresos'] = Ingresos::with('articulo','sucursal','compra','almacen')
                ->fecha($request->get('fecha'))
                ->sucursal($request->get('sucursal'))
                ->articulo($request->get('articulo'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.inarticulos.list')->with($this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
    function genDatos(){
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['compras']=Compra::pluck('fecha');
        $this->datos['articulos']=Articulo::orderBy('nombre')->pluck('nombre','id');
    }


    public function deleteItemsCompra($id)
    {
        if(Auth::user()->can('allow-delete')) {
            $ingreso = Ingresos::find($id);
            /*
              * reducimos de stock
              */
            $compra = Compra::find($ingreso->compra_id);
            if($compra->estado =='t'){

                $existencia = new IAManager($ingreso->articulo_id, $ingreso->sucursal_id, $ingreso->almacen_id);
                $existencia->down($ingreso->cantidad);
            }

            Ingresos::destroy($id);
            return redirect()->back();
            //return redirect()->route('admin.compra.create');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
