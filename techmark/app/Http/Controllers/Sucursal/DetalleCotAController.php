<?php

namespace App\Http\Controllers\Sucursal;
use App\Almacen;
use App\Articulo;
use App\Cart;
use App\Compra;
use App\DetalleCotizacion;
use App\Http\Controllers\Controller;
use App\Ingresos;
use App\Proveedor;
use App\Rol;
use App\Sucursal;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DetalleCotAController extends Controller
{
    private  $datos = null;

    public function deleteItemsVentaArticulo($id)
    {
        if(Auth::user()->can('allow-delete')) {
            DetalleCotizacion::destroy($id);
            return redirect()->back();
            //return redirect()->route('admin.compra.create');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }

    public function deleteItemsCompra($id)
    {
        if(Auth::user()->can('allow-delete')) {
            DetalleCotizacion::destroy($id);
            return redirect()->back();
            //return redirect()->route('admin.compra.create');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
