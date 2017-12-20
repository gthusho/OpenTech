<?php

namespace App\Http\Controllers\Admin;

use App\Almacen;
use App\Articulo;
use App\Clientes;
use App\DetalleVentaArticulo;
use App\DetalleVentaProducto;
use App\IAManager;
use App\IPManager;
use App\Producto;
use App\ProductoTalla;
use App\Sucursal;
use App\Tool;
use App\VentaArticulo;
use App\VentaProducto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VentasProductosController extends Controller
{
    private  $datos = null;
    private  $venta = null;

    function __construct()
    {
        $this->setVenta();
    }

    /**
     * metodo me devuelve o crea una venta
     */
    function setVenta(){
        //estados = t=>terminado , p=>pendiente
        $query = VentaProducto::where('usuario_id',Auth::user()->id)->where('estado','p')->get();
        if(Tool::existe($query)){
            $this->venta = $query->first();
        }else{
            $this->venta = new  VentaProducto();
            $this->venta->usuario_id = Auth::user()->id;
            $this->venta->save();
        }
    }



    /**
     * inicializa datos para los combos
     */
    function genDataIni(){
        $this->datos['sucursales'] = Sucursal::where('estado',1)->orderBy('nombre')->get()->lists('nombre','id');
    }


    function setProducto($producto_id,$talla_id, $cantidad, $precio){
        $productoVenta = null;
        $query = DetalleVentaProducto::where('venta_producto_id',$this->venta->id)
            ->where('talla_id',$talla_id)
            ->where('producto_id',$producto_id)->get();
        $producto_talla=ProductoTalla::where('producto_id',$producto_id)->where('talla_id',$talla_id)->get()->first();
        if(Tool::existe($query)){
            $productoVenta = $query->first();
            switch ($precio){
                case ("1"):
                    $productoVenta->dp="P1";
                    $productoVenta->precio=$producto_talla->precio1* $cantidad;
                    break;
                case ("2"):
                    $productoVenta->dp="P2";
                    $productoVenta->precio=$producto_talla->precio2* $cantidad;
                    break;
                default:
                    $productoVenta->dp="P3";
                    $productoVenta->precio=$producto_talla->precio3* $cantidad;
            }
            /*
            * modifico la existencia al modificar una venta
            */

            $productoVenta->cantidad = $cantidad;
            $productoVenta->save();
        }else{
            $productoVenta = new  DetalleVentaProducto();
            $productoVenta->venta_producto_id = $this->venta->id;
            $productoVenta->producto_id = $producto_id;
            $productoVenta->usuario_id = Auth::user()->id;
            $productoVenta->cantidad = $cantidad;
            $productoVenta->talla_id = $talla_id;
            switch ($precio){
                case ("1"):
                    $productoVenta->dp="P1";
                    $productoVenta->precio=$producto_talla->precio1* $cantidad;
                    break;
                case ("2"):
                    $productoVenta->dp="P2";
                    $productoVenta->precio=$producto_talla->precio2* $cantidad;
                    break;
                case ("3"):
                    $productoVenta->dp="P3";
                    $productoVenta->precio=$producto_talla->precio3* $cantidad;
                    break;
            }

            $productoVenta->save();
        }
    }

    function updateVenta(){
        \DB::table('detalles_ventas_productos')
            ->where('venta_producto_id', $this->venta->id)
            ->update(['sucursal_id' => $this->venta->sucursal_id]);
    }


    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Ventas de Productos Registradas',route('admin.ventas.productos.index'),'Ventas');
            $this->datos['ventas'] = VentaProducto::with('cliente','usuario','sucursal')
                ->fecha($request->get('fecha'))
                ->whereIn('estado',['t','c'])
                ->codigo($request->get('s'))
                ->sucursal($request->get('sucursal'))
                ->cliente($request->get('cliente'))
                ->cliente($request->get('c'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.venta_pro.list',$this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
    function genDatos(){
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['clientes'] = [];

        foreach (Clientes::orderBy('razon_social')->get() as $row)
            $this->datos['clientes'][$row->id] = $row->razon_social .' - '.$row->nit;
    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Registrar una Venta',route('admin.ventas.productos.index'),'Ventas Productos');
            //inicializo loscombos
            $this->genDataIni();
            //mando la compra pre-registrada y/o obtenida en el constructor

            $this->datos['razon_social'] = null;
            $this->datos['nit'] = null;
            if($this->venta->cliente_id!='' || $this->venta->cliente_id!=0){
                $this->datos['razon_social'] = $this->venta->cliente->razon_social;
                $this->datos['nit'] = $this->venta->cliente->nit;
            }
            $this->datos['venta'] = $this->venta;
            return view('cpanel.admin.venta_pro.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }
    public function confirmVenta($id,$stado,Request $request){
        $venta = VentaProducto::find($id);
        if($stado=='t'){
            $venta->fill($request->all());//aumentar esto
            $venta->estado = 't';
            foreach ($venta->detalleventas as $row){
                $existencia = new IPManager($row->producto_id,$row->talla_id, $venta->sucursal_id);
                $existencia->down($row->cantidad);
                $det=DetalleVentaProducto::find($row->id);
                $det->sucursal_id=$venta->sucursal_id;
                $det->save();
            }
        }elseif ($stado=='c'){
            if($venta->estado == 't'){
                foreach ($venta->detalleventas as $row){
                    $existencia = new IPManager($row->producto_id,$row->talla_id, $venta->sucursal_id);
                    $existencia->add($row->cantidad);
                }
            }
            $venta->estado = 'c';

        }

        $venta->save();
        /*
       * egreso items a existencia una vez terminado la venta
       */

        /// enviar la url del reporte en la variable tiket
        //\Session::flash('tiket',url('reportes/venta').'?id='.$venta->id);
        return redirect()->route('admin.ventas.productos.index');
    }

    public function store(Request $request)
    {

        if(Auth::user()->can('allow-insert')){

            //actualizo la compra de ser necesario
            $this->venta->fill($request->all());
            $this->venta->sucursal_id = $request->get('sucursal_id');
            $this->venta->save();


            //valido si me envias un articulo id
            if($request->get('producto_id')!=''&& $request->get('talla_id')!='' && $request->get('xCantidad')!='' && $request->get('xPrecio')!=''){
                $this->setProducto($request->get('producto_id'),$request->get('talla_id'),$request->get('xCantidad'),$request->get('xPrecio'));
            }

            //actualzamos los datos de ingresos con referencia a los cambios en compra si uera necesario

            $this->updateVenta();

            return redirect()->back();
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar Venta',route('admin.ventas.productos.index'),'Venta de Productos');
            $this->genDataIni();
            $this->datos['venta'] = VentaProducto::find($id);
            $this->datos['razon_social'] = $this->datos['venta']->cliente->razon_social;
            $this->datos['nit'] = $this->datos['venta']->cliente->nit;
            return view('cpanel.admin.venta_pro.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }


    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            //actualizo la compra de ser necesario
            $this->venta = VentaProducto::find($id);
            $this->venta->cliente_id = $request->get('cliente_id');
//            $this->venta->tipo_pago = $request->get('tipo_pago');
            $this->venta->observaciones = $request->get('observaciones');
            $this->venta->sucursal_id = $request->get('sucursal_id');
            $this->venta->abono = $request->get('abono');
            $this->venta->save();

            //valido si me envias un articulo id
            if($request->get('producto_id')!=''&& $request->get('talla_id')!='' && $request->get('xCantidad')!='' && $request->get('xPrecio')!=''){
                $this->setProducto($request->get('producto_id'),$request->get('talla_id'),$request->get('xCantidad'),$request->get('xPrecio'));
            }

            //actualzamos los datos de ingresos con referencia a los cambios en compra si uera necesario

            $this->updateVenta();


            return redirect()->back();
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('allow-delete')) {
            $venta =  VentaProducto::find($id);
            if($venta->estado == 't'){
                foreach ($venta->detalleventas as $row){
                    $existencia = new IPManager($row->producto_id,$row->talla_id, $venta->sucursal_id);
                    $existencia->add($row->cantidad);
                }
            }
            \DB::table('detalles_ventas_productos')->where('venta_producto_id',$venta->id)->delete();
            \DB::table('ventas_credito_productos')->where('venta_producto_id',$venta->id)->delete();
            VentaArticulo::destroy($id);
            $mensaje = 'La Venta fue Elminada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.ventas.productos.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
    public function destroyItemCar($id)
    {

        if(Auth::user()->can('allow-delete')) {
            $ventaProducto =  DetalleVentaProducto::find($id);
            if($ventaProducto->ventaproducto->estado == 't'){
                $existencia = new IPManager($ventaProducto->producto_id,$ventaProducto->talla_id, $ventaProducto->sucursal_id);
                $existencia->add($ventaProducto->cantidad);
            }
            DetalleVentaProducto::destroy($id);
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
