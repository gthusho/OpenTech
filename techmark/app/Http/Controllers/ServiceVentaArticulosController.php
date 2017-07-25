<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Clientes;
use App\DetalleVentaArticulo;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServiceVentaArticulosController extends Controller
{
    public function getArticuloForVenta(Request $request){
        $query = null;
        switch ($request->get('type')){
            case "codigo":{
                $query = Articulo::where('codigo',$request->get('data'))->get();
                break;
            }
            case "barra":{
                $query = Articulo::where('codigobarra',$request->get('data'))->get();
                break;
            }
            default: abort(1000);
        }

        if(Tool::existe($query)){
            $item =  $query->first();

            $data = [
                'id'=>$item->id,
                'nombre'=>$item->nombre,
                'unidad'=>$item->medida->nombre,
                'categoria'=>$item->categoria->nombre,
                'material'=>$item->material->nombre,
                'marca'=>$item->marca->nombre,
                'precio1'=>Tool::convertMoney($item->precio1),
                'precio2'=>Tool::convertMoney($item->precio2),
                'precio3'=>Tool::convertMoney($item->precio3),
                'stockIventario'=>$item->getStockAll(),
                'xcantidad'=>'',
                'xprecio'=>'',
                'dp'=>'P1'

            ];

            return $data;
        }else{
            abort(1000);
        }


    }

    public function getClienteForVenta(Request $request){
        $query = Clientes::where('nit',$request->get('data'))->get();

        if(Tool::existe($query)){
            $item =  $query->first();

            $data = [
                'id'=>$item->id,
                'razon_social'=>$item->razon_social

            ];

            return $data;
        }else{
            abort(1000);
        }


    }

    function registrarCliente(Requests\AddAjaxClienteRequest $request){

        $cliente = new Clientes();
        $cliente->razon_social = $request->get('nombre');
        $cliente->nit = $request->get('nit');
        $cliente->save();



        return ['razon_social'=>$cliente->razon_social,'nit'=>$cliente->nit,'id'=>$cliente->id];

    }
    public function showArticleByEgresoId($id)
    {
        $egreso= DetalleVentaArticulo::find($id);
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
