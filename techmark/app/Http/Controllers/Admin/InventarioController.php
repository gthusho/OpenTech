<?php

namespace App\Http\Controllers\Admin;
use App\ExistenciaArticulo;
use App\Http\Controllers\Controller;
use App\Tool;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class InventarioController extends Controller
{

    private  $datos = null;
    function articulos(Request $request){
        $this->datos['brand'] = Tool::brand('Stock Articulos',route('inventario.articulos'),'Inventario');
        $this->datos['articulos'] = ExistenciaArticulo::orderBy('articulo_id','desc')->paginate(50);
        return view('cpanel.admin.inventario.articulos.list',$this->datos);
    }

}
