<?php

namespace App\Http\Controllers\Admin;

use App\DetalleVentaArticulo;
use App\Tool;
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
            DetalleVentaArticulo::destroy($id);
            return redirect()->back();
            //return redirect()->route('admin.compra.create');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
