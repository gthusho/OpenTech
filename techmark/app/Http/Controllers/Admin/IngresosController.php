<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Ingresos;
use App\Rol;
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
            $this->datos['ingresos'] = Ingresos::orderBy('id','desc')
                ->paginate();
            return view('cpanel.admin.inarticulos.list')->with($this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }


    public function deleteItemsCompra($id)
    {
        if(Auth::user()->can('allow-delete')) {
            Ingresos::destroy($id);
            return redirect()->back();
            //return redirect()->route('admin.compra.create');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
