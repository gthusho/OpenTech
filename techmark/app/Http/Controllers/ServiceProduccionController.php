<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\DetalleProduccion;
use App\DetProduccionCliente;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServiceProduccionController extends Controller
{
    public function showArticleByProduccionId($id)
    {
        $produccion= DetalleProduccion::find($id);
        $item = Articulo::find($produccion->articulo_id);
        $data = [
            'id'=>$item->id,
            'nombre'=>$item->nombre,
            'unidad'=>$item->medida->nombre,
            'categoria'=>$item->categoria->nombre,
            'material'=>$item->material->nombre,
            'marca'=>$item->marca->nombre,
            'dp'=>$produccion->dp,
            'xcantidad'=>number_format((float)$produccion->cantidad, 2, '.', ''),
            'xcosto'=>number_format((float)$produccion->costo, 2, '.', ''),
            'precio1'=>Tool::convertMoney($item->precio1),
            'precio2'=>Tool::convertMoney($item->precio2),
            'precio3'=>Tool::convertMoney($item->precio3),
            'precio4'=>Tool::convertMoney($item->precio4),
            'precio5'=>Tool::convertMoney($item->precio5),
            'stockIventario'=>$item->getStockAll(),

        ];
        return $data;
    }
    function CArticleByProduccionId($id){
        $produccion= DetProduccionCliente::find($id);
        $item = Articulo::find($produccion->articulo_id);
        $data = [
            'id'=>$item->id,
            'nombre'=>$item->nombre,
            'unidad'=>$item->medida->nombre,
            'categoria'=>$item->categoria->nombre,
            'material'=>$item->material->nombre,
            'marca'=>$item->marca->nombre,
            'dp'=>$produccion->dp,
            'xcantidad'=>number_format((float)$produccion->cantidad, 2, '.', ''),
            'xcosto'=>number_format((float)$produccion->costo, 2, '.', ''),
            'precio1'=>Tool::convertMoney($item->precio1),
            'precio2'=>Tool::convertMoney($item->precio2),
            'precio3'=>Tool::convertMoney($item->precio3),
            'precio4'=>Tool::convertMoney($item->precio4),
            'precio5'=>Tool::convertMoney($item->precio5),
            'stockIventario'=>$item->getStockAll(),

        ];
        return $data;
    }
}
