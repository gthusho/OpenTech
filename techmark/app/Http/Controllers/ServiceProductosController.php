<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Clientes;
use App\Ingresos;
use App\Producto;
use App\ProductoTalla;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServiceProductosController extends Controller
{

    /**
     * @param Request $request
     * @return array
     */
    private $talla_id = null;
    private $stock = 0;
    private $precio = [0,0,0];
    public function productByCode(Request $request){
        $query = null;
        switch ($request->get('type')){
            case "codigo":{
                $query = Producto::where('codigo',$request->get('data'))->get();
                break;
            }
            case "barra":{
                $query = Producto::where('codigobarra',$request->get('data'))->get();
                break;
            }
            default: abort(1000);
        }

        if(Tool::existe($query)){
            $item =  $query->first();

            $data = [
                'producto_id'=>$item->id,
                'talla_id'=>$this->talla_id,
                'nombre'=>$item->descripcion,
                'tallas'=>$this->tallasToHtml($item->tallas),
                'imagen'=>$item->getImagen(),
                'stock'=>$this->stock,
                'precio1'=>Tool::convertMoney($this->precio[0]),
                'precio2'=>Tool::convertMoney($this->precio[1]),
                'precio3'=>Tool::convertMoney($this->precio[2]),
            ];

            return $data;
        }else{
            abort(1000);
        }

        return null;
    }

    /**
     * @param $tallas
     * @return null
     */
    function tallasToHtml($tallas){
        $data = null;
        $b=false;

        foreach ($tallas as $row){
            if(!$b){
                $this->talla_id = $row->talla->id;
                $this->precio[0]= $row->precio1;
                $this->precio[1]= $row->precio2;
                $this->precio[2]= $row->precio3;
                $b=true;
            }
            $data .= "<option value='{$row->id}'>{$row->talla->nombre}</option>";
        }
        return $data;
    }
    function priceByIdProduct(Request $request){

        $query = ProductoTalla::find($request->get('id'));
        if(Tool::existe($query)){
            $item =  $query;

            $data = [
                'talla_id'=>$item->talla_id,
                'stock'=>$this->stock,
                'precio1'=>Tool::convertMoney($item->precio1),
                'precio2'=>Tool::convertMoney($item->precio2),
                'precio3'=>Tool::convertMoney($item->precio3),
            ];

            return $data;
        }else{
            abort(1000);
        }
    }
//    function getListArticulos(Request $request){
//        $query = Articulo::tipo(0,$request->get('data'))->get();
//        if(Tool::existe($query)){
//            $data = "";
//            foreach ($query as $row){
//                $data .= "
//                    <tr data-id='{$row->id}'>
//                    <td>{$row->nombre}</td>
//                    <td>{$row->categoria->nombre}</td>
//                    <td>{$row->marca->nombre}</td>
//                    <td>{$row->material->nombre}</td>
//                    <td><button class='btn btn-primary btn-sm' onclick='genListSubData({$row->id})'><i class=' icon-action-redo'></i></button></td>
//                    </tr>
//                ";
//            }
//            echo $data;
//        }else{
//            abort(1000);
//        }
//
//    }
//
//    public function showArticleByIngresoId($id)
//    {
//        $ingreso = Ingresos::find($id);
//        $item = Articulo::find($ingreso->articulo_id);
//        $data = [
//            'id'=>$item->id,
//            'nombre'=>$item->nombre,
//            'unidad'=>$item->medida->nombre,
//            'categoria'=>$item->categoria->nombre,
//            'material'=>$item->material->nombre,
//            'marca'=>$item->marca->nombre,
//            'costo'=>Tool::convertMoney($item->costo),
//            'precio'=>Tool::convertMoney($item->precio1),
//            'xcantidad'=>number_format((float)$ingreso->cantidad, 2, '.', ''),
//            'xcosto'=>number_format((float)$ingreso->costo, 2, '.', ''),
//            'stockIventario'=>$item->getStockAll(),
//
//        ];
//        return $data;
//    }
//    public function showArticle(Request $request)
//    {
//        $item = Articulo::find($request->get('data'));
//        $data = [
//            'id'=>$item->id,
//            'nombre'=>$item->nombre,
//            'unidad'=>$item->medida->nombre,
//            'categoria'=>$item->categoria->nombre,
//            'material'=>$item->material->nombre,
//            'marca'=>$item->marca->nombre,
//            'costo'=>Tool::convertMoney($item->costo),
//            'precio'=>Tool::convertMoney($item->precio1),
//            'xcantidad'=>'',
//            'xcosto'=>'',
//            'stockIventario'=>$item->getStockAll(),
//            'precio1'=>Tool::convertMoney($item->precio1),
//            'precio2'=>Tool::convertMoney($item->precio2),
//            'precio3'=>Tool::convertMoney($item->precio3),
//            'dp'=>'P1'
//        ];
//        return $data;
//    }

}