<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Clientes;
use App\Ingresos;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServiceArticulosController extends Controller
{
    /**
     * metodo para el ajax del buscador codigo o codigo barra
     * @param Request $request
     * @return array
     */
    public function getArticuloByCodigo(Request $request){
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
                'costo'=>Tool::convertMoney($item->costo),
                'precio'=>Tool::convertMoney($item->precio1),
                'stockIventario'=>$item->getStockAll(),
                'xcantidad'=>'',
                'xcosto'=>'',
                'dp'=>'P1'

            ];

            return $data;
        }else{
            abort(1000);
        }


    }
    function getListArticulos(Request $request){
        $query = Articulo::tipo(0,$request->get('data'))->get();
        if(Tool::existe($query)){
            $data = "";
            foreach ($query as $row){
                $data .= "
                    <tr data-id='{$row->id}'>
                    <td>{$row->nombre}</td>
                    <td>{$row->categoria->nombre}</td>
                    <td>{$row->marca->nombre}</td>
                    <td>{$row->material->nombre}</td>
                    <td><button class='btn btn-primary btn-sm' onclick='genListSubData({$row->id})'><i class=' icon-action-redo'></i></button></td>
                    </tr>
                ";
            }
            echo $data;
        }else{
            abort(1000);
        }

    }

    public function showArticleByIngresoId($id)
    {
        $ingreso = Ingresos::find($id);
        $item = Articulo::find($ingreso->articulo_id);
        $data = [
            'id'=>$item->id,
            'nombre'=>$item->nombre,
            'unidad'=>$item->medida->nombre,
            'categoria'=>$item->categoria->nombre,
            'material'=>$item->material->nombre,
            'marca'=>$item->marca->nombre,
            'costo'=>Tool::convertMoney($item->costo),
            'precio'=>Tool::convertMoney($item->precio1),
            'xcantidad'=>number_format((float)$ingreso->cantidad, 2, '.', ''),
            'xcosto'=>number_format((float)$ingreso->costo, 2, '.', ''),
            'stockIventario'=>$item->getStockAll(),

        ];
        return $data;
    }
    public function showArticle(Request $request)
    {
        $item = Articulo::find($request->get('data'));
        $data = [
            'id'=>$item->id,
            'nombre'=>$item->nombre,
            'unidad'=>$item->medida->nombre,
            'categoria'=>$item->categoria->nombre,
            'material'=>$item->material->nombre,
            'marca'=>$item->marca->nombre,
            'costo'=>Tool::convertMoney($item->costo),
            'precio'=>Tool::convertMoney($item->precio1),
            'xcantidad'=>'',
            'xcosto'=>'',
            'stockIventario'=>$item->getStockAll(),
            'precio1'=>Tool::convertMoney($item->precio1),
            'precio2'=>Tool::convertMoney($item->precio2),
            'precio3'=>Tool::convertMoney($item->precio3),
            'dp'=>'P1'
        ];
        return $data;
    }

}
