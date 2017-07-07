<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Clientes;
use App\DetalleCotizacion;
use App\DetalleVentaArticulo;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServiceCotizacionArticulosController extends Controller
{

    public function showArticleByCotizacionId($id)
    {
        $egreso= DetalleCotizacion::find($id);
        $item = Articulo::find($egreso->articulo_id);
        $data = [
            'id'=>$item->id,
            'nombre'=>$item->nombre,
            'unidad'=>$item->medida->nombre,
            'categoria'=>$item->categoria->nombre,
            'material'=>$item->material->nombre,
            'marca'=>$item->marca->nombre,
            'dp'=>$egreso->dp,
            'xcantidad'=>number_format((float)$egreso->cantidad, 2, '.', ''),
            'xcosto'=>number_format((float)$egreso->costo, 2, '.', ''),
            'precio1'=>Tool::convertMoney($item->precio1),
            'precio2'=>Tool::convertMoney($item->precio2),
            'precio3'=>Tool::convertMoney($item->precio3),
            'stockIventario'=>$item->getStockAll(),

        ];
        return $data;
    }
}
