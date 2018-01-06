<?php

namespace App\Http\Controllers;

use App\DetalleCotizacionProducto;
use App\DetalleProductoBase;
use App\ProductoBase;
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
                    <tr data-id='{$row->id}' onclick='genListSubData({$row->id})'>
                    <td>{$row->prodbase->descripcion}</td>
                    <td>{$row->material->nombre}</td>
                    <td>{$row->talla->nombre}</td>
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
    public function productoById($id)
    {

        $dCotizacionP =  DetalleCotizacionProducto::find($id);
        $item = ProductoBase::find($dCotizacionP->productos_base_id);
        $data = [
            'id'=>$dCotizacionP->id,
            'producto'=>$item->descripcion,
            'producto_id'=>$item->id,
            'talla'=>$dCotizacionP->talla->nombre,
            'talla_id'=>$dCotizacionP->talla_id,
            'material'=>$dCotizacionP->material->nombre,
            'material_id'=>$dCotizacionP->material_id,
            'costo'=>Tool::convertMoney($dCotizacionP->costo),
            'precio'=>Tool::convertMoney($dCotizacionP->precio),
            'xcantidad'=>$dCotizacionP->cantidad,
            'xdescripcion'=>$dCotizacionP->descripcion,
            'xprecio'=>$dCotizacionP->precio,
            'elprecio'=>$dCotizacionP->precio
        ];
        return $data;
    }
}
