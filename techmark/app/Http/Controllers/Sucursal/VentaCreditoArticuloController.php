<?php

namespace App\Http\Controllers\Sucursal;

use App\Tool;
use App\VentaArticulo;
use App\VentaCreditoArticulo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VentaCreditoArticuloController extends Controller
{
    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Ventas al Credito Registradas',route('venta-credito-art.index'),'Ventas al Credito');
            $this->datos['ventas'] = VentaArticulo::fecha($request->get('fecha'))
                ->where('estado','t')->where('tipo_pago','Credito')
                ->fecha($request->get('f'))
                ->usuario(Auth::user()->id)
                ->codigo($request->get('s'))
                ->orderBy('id','desc')
                ->paginate();
            return view('cpanel.sucursal.venta-credito-art.list',$this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }


    public function show($id)
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Pago Venta Credito',route('venta-credito-art.index'),'Ventas al Credito');

            $this->datos['venta'] = VentaArticulo::find($id);

            return view('cpanel.sucursal.venta-credito-art.edit',$this->datos);
        }


        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

}
