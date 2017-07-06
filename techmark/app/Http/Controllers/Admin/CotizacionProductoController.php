<?php

namespace App\Http\Controllers\Admin;

use App\CotizacionProducto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CotizacionProductoController extends Controller
{
    private  $datos = null;
    private  $cotizacion = null;

    function __construct()
    {
        $this->setCotizacion();
    }

    /**
     * metodo me devuelve o crea una venta
     */
    function setCotizacion(){
        //estados = t=>terminado , p=>pendiente
        $query = CotizacionProducto::where('usuario_id',Auth::user()->id)->where('estado','p')->get();
        if(Tool::existe($query)){
            $this->cotizacion = $query->first();
        }else{
            $this->cotizacion = new  CotizacionProducto();
            $this->cotizacion->usuario_id = Auth::user()->id;
            $this->cotizacion->cliente_id = 1;
            $this->cotizacion->sucursal_id=1;
            $this->cotizacion->save();
        }
    }



    /**
     * inicializa datos para los combos
     */
    function genDataIni(){
        $this->datos['sucursales'] = Sucursal::where('estado',1)->orderBy('nombre')->get()->lists('nombre','id');
    }

    /**
     * metodo para el ajax del buscador codigo o codigo barra
     * @param Request $request
     * @return array
     */
    /*public function getArticuloForVenta(Request $request){
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
                'xprecio'=>''

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


    }*/

    function setArticulo($articulo_id, $cantidad){
        $articulo = null;
        $query = DetalleVentaArticulo::where('venta_articulo_id',$this->venta->id)->where('articulo_id',$articulo_id)->get();
        if(Tool::existe($query)){
            $articulo = $query->first();
            $articulo->cantidad = $cantidad;
            $articulo->save();
        }else{
            $articulo = new  DetalleVentaArticulo();
            $articulo->venta_articulo_id = $this->venta->id;
            $articulo->sucursal_id = $this->venta->sucursal_id;
            $articulo->articulo_id = $articulo_id;
            $articulo->usuario_id = Auth::user()->id;
            $articulo->cantidad = $cantidad;
            $articulo->almacen_id = $this->venta->almacen_id;

            $articulo->save();
        }
    }

    function updateVenta(){
        \DB::table('detalles_ventas_articulos')
            ->where('venta_articulo_id', $this->venta->id)
            ->update(['sucursal_id' => $this->venta->sucursal_id,'almacen_id'=>$this->venta->almacen_id]);
    }

    /*function getListArticulos(Request $request){
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

    }*/

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Ventas de Articulos Registradas',route('admin.venta_art.index'),'Ventas');
            $this->datos['ventas'] = VentaArticulo::with('cliente','usuario','sucursal','almacen')
                ->fecha($request->get('fecha'))
                ->where('estado','t')
                ->fecha($request->get('f'))
                ->codigo($request->get('s'))
                ->orderBy('id','desc')
                ->paginate();
            return view('cpanel.admin.venta_art.list',$this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Registrar una Venta',route('admin.venta_art.index'),'Ventas de Articulos');
            //inicializo loscombos
            $this->genDataIni();
            //mando la compra pre-registrada y/o obtenida en el constructor

            $this->datos['venta'] = $this->venta;

            return view('cpanel.admin.venta_art.registro',$this->datos);
        }


        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }
    public function confirmVenta($id){
        $venta = VentaArticulo::find($id);
        $venta->estado = 't';
        $venta->save();
        return redirect()->route('admin.venta_art.index');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){

            //actualizo la compra de ser necesario
            $this->venta->fill($request->all());
            $this->venta->save();


            //valido si me envias un articulo id
            if($request->get('articulo_id')!='' && $request->get('xCantidad')!='' && $request->get('xPrecio')!=''){
                $this->setArticulo($request->get('articulo_id'),$request->get('xCantidad'),$request->get('xPrecio'));
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
            $this->datos['brand'] = Tool::brand('Editar Venta',route('admin.venta_art.index'),'Venta de Articulos');
            $this->genDataIni();
            $this->datos['venta'] = VentaArticulo::find($id);
            return view('cpanel.admin.venta_art.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }


    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            //actualizo la compra de ser necesario
            $this->venta = VentaArticulo::find($id);
            $this->venta->fill($request->all());
            $this->venta->save();


            //valido si me envias un articulo id
            if($request->get('articulo_id')!=''){
                $this->setArticulo($request->get('articulo_id'),$request->get('xCantidad'),$request->get('xPrecio'));
            }

            //actualzamos los datos de ingresos con referencia a los cambios en compra si uera necesario

            $this->updateVenta();


            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

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
            $venta =  VentaArticulo::find($id);
            \DB::table('detalles_ventas_articulos')->where('venta_articulo_id',$venta->id)->delete();
            VentaArticulo::destroy($id);
            $mensaje = 'La Venta fue Cancelada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.venta_art.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
