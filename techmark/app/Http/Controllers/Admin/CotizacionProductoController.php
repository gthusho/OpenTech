<?php

namespace App\Http\Controllers\Admin;

use App\Clientes;
use App\CotizacionProducto;
use App\DetalleCotizacionProducto;
use App\DetalleProductoBase;
use App\Sucursal;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        //estados = t=>terminado, p=>pendiente, a=>adjudicada
        $query = CotizacionProducto::where('usuario_id',Auth::user()->id)->where('estado','p')->get();
        if(Tool::existe($query)){
            $this->cotizacion = $query->first();
        }else{
            $this->cotizacion = new  CotizacionProducto();
            $this->cotizacion->usuario_id = Auth::user()->id;
            /*$this->cotizacion->cliente_id = 1;
            $this->cotizacion->sucursal_id = 1;*/
            $this->cotizacion->estado='p';
            $this->cotizacion->save();
        }
    }



    /**
     * inicializa datos para los combos
     */
    function genDataIni(){
        $this->datos['sucursales'] = Sucursal::where('estado',1)->orderBy('nombre')->get()->lists('nombre','id');
    }

    function setProducto($producto_base_id, $cantidad, $precio, $material_id, $talla_id, $descripcion){
        $producto = null;
        $query = DetalleCotizacionProducto::where('cotizacion_producto_id',$this->cotizacion->id)->where('productos_base_id',$producto_base_id)->where('material_id',$material_id)->where('talla_id',$talla_id)->get();
        if(Tool::existe($query)){
            $producto = $query->first();
            $producto->cantidad = $cantidad;
            $producto->precio= $precio ;
            $producto->descripcion=$descripcion;
            $producto->save();
        }else{
            $producto = new  DetalleCotizacionProducto();
            $producto->cotizacion_producto_id = $this->cotizacion->id;
            $producto->sucursal_id = $this->cotizacion->sucursal_id;
            $producto->productos_base_id = $producto_base_id;
            $producto->usuario_id = Auth::user()->id;
            $producto->cantidad = $cantidad;
            $producto->precio= $precio ;
            $producto->material_id=$material_id;
            $producto->talla_id=$talla_id;
            $producto->descripcion=$descripcion;

            $producto->save();
        }
    }

    function updateCotizacion(){
        \DB::table('detalle_cotizaciones_productos')
            ->where('cotizacion_producto_id', $this->cotizacion->id)
            ->update(['sucursal_id' => $this->cotizacion->sucursal_id]);
    }

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Cotizacion de Productos Registrados',route('admin.cot_producto.index'),'Cotizacion');
            $this->datos['cotizaciones'] = CotizacionProducto::with('cliente','usuario','sucursal')
                ->fecha($request->get('fecha'))
                ->where('estado','t')
                ->orWhere('estado','a')
                ->codigo($request->get('s'))
                ->sucursal($request->get('sucursal'))
                ->cliente($request->get('cliente'))
                ->cliente($request->get('c'))
                ->estado($request->get('estado'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.cot_producto.list',$this->datos);
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
            $this->datos['brand'] = Tool::brand('Registrar una Cotizacion',route('admin.cot_producto.index'),'Cotizacion de Productos');
            //inicializo loscombos
            $this->genDataIni();
            //mando la compra pre-registrada y/o obtenida en el constructor

            $this->datos['razon_social'] = null;
            $this->datos['nit'] = null;
            if($this->cotizacion->cliente_id!='' || $this->cotizacion->cliente_id!=0){
                $this->datos['razon_social'] = $this->cotizacion->cliente->razon_social;
                $this->datos['nit'] = $this->cotizacion->cliente->nit;
            }

            $this->datos['cotizacion'] = $this->cotizacion;

            return view('cpanel.admin.cot_producto.registro',$this->datos);
        }


        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }
    public function confirmCotizacionProducto($id, Request $request){
        $cotizacion = CotizacionProducto::find($id);
        $cotizacion->estado = 't';
        $cotizacion->cliente_id=$request->get('HCcliente');
        $cotizacion->sucursal_id=$request->get('HCsucursal');
        $cotizacion->fvalides=$request->get('HCfecha');
        $cotizacion->save();
        return redirect()->route('admin.cot_producto.index');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){

            //actualizo la compra de ser necesario
            $this->cotizacion->fill($request->all());
            $this->cotizacion->save();


            //valido si me envias un articulo id
            if($request->get('producto_id')!='' && $request->get('xCantidad')!='' && $request->get('xPrecio')!='' && $request->get('material_id')!='' && $request->get('talla_id')!=''){
                $this->setProducto($request->get('producto_id'),$request->get('xCantidad'),$request->get('xPrecio'),$request->get('material_id'),$request->get('talla_id'),$request->get('xDescripcion'));
            }

            //actualzamos los datos de ingresos con referencia a los cambios en compra si uera necesario

            $this->updateCotizacion();


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
            $this->datos['brand'] = Tool::brand('Editar Cotizacion',route('admin.cot_producto.index'),'Cotizacion de Productos');
            $this->genDataIni();
            $this->datos['cotizacion'] = CotizacionProducto::find($id);
            $this->datos['razon_social'] = $this->datos['cotizacion']->cliente->razon_social;
            $this->datos['nit'] = $this->datos['cotizacion']->cliente->nit;
            return view('cpanel.admin.cot_producto.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }


    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            //actualizo la compra de ser necesario
            $this->cotizacion = CotizacionProducto::find($id);
            $this->cotizacion->fill($request->all());
            $this->cotizacion->save();

            //valido si me envias un articulo id
            if($request->get('producto_id')!='' && $request->get('xCantidad')!='' && $request->get('xPrecio')!='' && $request->get('material_id')!='' && $request->get('talla_id')!=''){
                $this->setProducto($request->get('producto_id'),$request->get('xCantidad'),$request->get('xPrecio'),$request->get('material_id'),$request->get('talla_id'),$request->get('xDescripcion'));
            }
            //actualzamos los datos de ingresos con referencia a los cambios en compra si uera necesario

            $this->updateCotizacion();


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
            $cotizacion =  CotizacionProducto::find($id);
            \DB::table('detalle_cotizaciones_productos')->where('cotizacion_producto_id',$cotizacion->id)->delete();
            CotizacionProducto::destroy($id);
            $mensaje = 'La Cotizacion fue eliminada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.cot_producto.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
