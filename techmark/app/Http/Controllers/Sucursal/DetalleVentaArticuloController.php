<?php

namespace App\Http\Controllers\Sucursal;

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
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
