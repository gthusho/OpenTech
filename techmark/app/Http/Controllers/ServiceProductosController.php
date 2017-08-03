<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Clientes;
use App\DetalleVentaProducto;
use App\Ingresos;
use App\IngresosProducto;
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
                'dp'=>'P1'
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
    function tallasRowToHtml($tallas,$id){
        $data = null;
        foreach ($tallas as $row){
           if($row->talla->id==$id){
               $data .= "<option value='{$row->id}' selected>{$row->talla->nombre}</option>";
           }else{
               $data .= "<option value='{$row->id}' >{$row->talla->nombre}</option>";
           }
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
    function productByRowId(Request $request){

        $ingreso = IngresosProducto::find($request->get('data'));
        if($ingreso != null || $ingreso !=''){
            $producto = Producto::find($ingreso->producto_id);

            $productoTalla = ProductoTalla::where('producto_id',$producto->id)->where('talla_id',$ingreso->talla_id)->get()->first();

            $data = [
                'producto_id'=>$ingreso->producto_id,
                'talla_id'=>$ingreso->talla_id,
                'nombre'=>$producto->descripcion,
                'tallas'=>$this->tallasRowToHtml($producto->tallas,$ingreso->talla_id),
                'imagen'=>$producto->getImagen(),
                'stock'=>$this->stock,
                'precio1'=>Tool::convertMoney($productoTalla->precio1),
                'precio2'=>Tool::convertMoney($productoTalla->precio2),
                'precio3'=>Tool::convertMoney($productoTalla->precio3),
                'xcantidad'=>$ingreso->cantidad,
            ];
            return $data;
        }else{
            abort(1000);
        }
    }
    function getListProductos(Request $request){
        $query = Producto::name($request->get('data'))->get();
        if(Tool::existe($query)){
            $data = "";
            foreach ($query as $producto){
                $productoTalla = ProductoTalla::where('producto_id',$producto->id)->get();
                foreach ($productoTalla as $row){
                    $data .= "
                    <tr data-id='{$row->id}'>
                    <td><img src='{$row->producto->getImagen()}' alt='' class='img img-thumbnail thumb-sm'></td>
                    <td>{$row->producto->descripcion}</td>
                    <td>{$row->talla->nombre}</td>
                    <td><button class='btn btn-primary btn-sm' onclick='genListSubData({$row->id})'><i class=' icon-action-redo'></i></button></td>
                    </tr>
                ";
                }
            }


            echo $data;
        }else{
            abort(1000);
        }

    }
    function showProductoSearch(Request $request){

        $productoTalla = ProductoTalla::find($request->get('data'));


        if($productoTalla != null || $productoTalla !=''){
            $producto = Producto::find($productoTalla->producto_id);


            $data = [
                'producto_id'=>$productoTalla->producto_id,
                'talla_id'=>$productoTalla->talla_id,
                'nombre'=>$producto->descripcion,
                'tallas'=>$this->tallasRowToHtml($producto->tallas,$productoTalla->talla_id),
                'imagen'=>$producto->getImagen(),
                'stock'=>$this->stock,
                'precio1'=>Tool::convertMoney($productoTalla->precio1),
                'precio2'=>Tool::convertMoney($productoTalla->precio2),
                'precio3'=>Tool::convertMoney($productoTalla->precio3),
                'xcantidad'=>'',
                'dp'=>'P1'
            ];
            return $data;
        }else{
            abort(1000);
        }
    }
    /*
     * busco de una venta ya registrada row
     */
    function ventaProductobyRow(Request $request){

        $productoVenta = DetalleVentaProducto::find($request->get('data'));


        if($productoVenta != null || $productoVenta !=''){
            $productoTalla = ProductoTalla::where('producto_id',$productoVenta->producto_id)->where('talla_id',$productoVenta->talla_id)->get()->first();
            $data = [
                'producto_id'=>$productoVenta->producto_id,
                'talla_id'=>$productoVenta->talla_id,
                'nombre'=>$productoVenta->producto->descripcion,
                'tallas'=>$this->tallasRowToHtml($productoVenta->producto->tallas,$productoVenta->talla_id),
                'imagen'=>$productoVenta->producto->getImagen(),
                'stock'=>$this->stock,
                'precio1'=>Tool::convertMoney($productoTalla->precio1),
                'precio2'=>Tool::convertMoney($productoTalla->precio2),
                'precio3'=>Tool::convertMoney($productoTalla->precio3),
                'xcantidad'=>$productoVenta->cantidad,
                'dp'=>$productoVenta->dp
            ];
            return $data;
        }else{
            abort(1000);
        }
    }
}
