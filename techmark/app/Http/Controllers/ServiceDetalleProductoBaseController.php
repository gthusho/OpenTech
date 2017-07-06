<?php

namespace App\Http\Controllers;

use App\DetalleProductoBase;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServiceDetalleProductoBaseController extends Controller
{
    function getListProductosBase(Request $request){
        $query = DetalleProductoBase::with('usuario','prodbase','talla','material')
            ->detProdBase($request->get('data'))->get();
        if(Tool::existe($query)){
            $data = "";
            foreach ($query as $row){
                $data .= "
                    <tr data-id='{$row->id}'>
                    <td>{$row->prodbase->descripcion}</td>
                    <td>{$row->material->nombre}</td>
                    <td>{$row->talla->nombre}</td>
                    <td><button class='btn btn-primary btn-sm' onclick='genListSubData({$row->id})'><i class=' icon-action-redo'></i></button></td>
                    </tr>
                ";
            }
            echo $data;
        }else{
            abort(1000);
        }

    }

    public function showDetalleProducto(Request $request)
    {
        $item = DetalleProductoBase::find($request->get('data'));
        $data = [
            'id'=>$item->id,
            'producto'=>$item->prodbase->descripcion,
            'producto_id'=>$item->producto_base_id,
            'talla'=>$item->talla->nombre,
            'talla_id'=>$item->talla_id,
            'material'=>$item->material->nombre,
            'material_id'=>$item->material_id,
            'costo'=>Tool::convertMoney($item->costo),
            'precio'=>Tool::convertMoney($item->precio),
            'xcantidad'=>'',
            'xdescripcion'=>'',
            'xprecio'=>'',
            'elprecio'=>$item->precio
        ];
        return $data;
    }
}
