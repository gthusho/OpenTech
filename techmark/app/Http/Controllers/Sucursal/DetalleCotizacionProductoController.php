<?php

namespace App\Http\Controllers\Sucursal;

use App\DetalleCotizacionProducto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetalleCotizacionProductoController extends Controller
{
    public function deleteItemsCotizacionProducto($id)
    {
        if(Auth::user()->can('allow-delete')) {
            DetalleCotizacionProducto::destroy($id);
            return redirect()->back();
            //return redirect()->route('admin.compra.create');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
