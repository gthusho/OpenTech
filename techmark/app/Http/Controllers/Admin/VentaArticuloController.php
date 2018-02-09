<?php

namespace App\Http\Controllers\Admin;

use App\Almacen;
use App\Articulo;
use App\Clientes;
use App\DetalleVentaArticulo;
use App\IAManager;
use App\Sucursal;
use App\Tool;
use App\VentaArticulo;
use App\VentaCreditoArticulo;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VentaArticuloController extends Controller
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
        $query = VentaArticulo::where('usuario_id',Auth::user()->id)->where('estado','p')->get();
        if(Tool::existe($query)){
            $this->venta = $query->first();
        }else{
            $this->venta = new  VentaArticulo();
            $this->venta->usuario_id = Auth::user()->id;
            $this->venta->save();
        }
    }



    /**
     * inicializa datos para los combos
     */
    function genDataIni(){
        $this->datos['sucursales'] = Sucursal::where('estado',1)->orderBy('nombre')->get()->lists('nombre','id');
        $this->datos['todos_clientes']=[];
        foreach (Clientes::where('estado',true)->orderBy('razon_social')->get() as $row)
            $this->datos['todos_clientes'][$row->id] = $row->razon_social .' - '.$row->nit;
    }

    /**
     * metodo para el ajax del buscador codigo o codigo barra
     * @param Request $request
     * @return array
     */


    /**
     * @param $articulo
     * @param $cantidad
     * @param $costo
     */
    function setArticulo($articulo_id, $cantidad, $precio){
        $articulo = null;
        $query = DetalleVentaArticulo::where('venta_articulo_id',$this->venta->id)->where('articulo_id',$articulo_id)->get();
        $parametro=Articulo::where('id',$articulo_id)->get()->first();
        if(Tool::existe($query)){
            $articulo = $query->first();
            switch ($precio){
                case ("1"):
                    $articulo->dp="P1";
                    $articulo->precio=$parametro->precio1* $cantidad;
                    break;
                case ("2"):
                    $articulo->dp="P2";
                    $articulo->precio=$parametro->precio2* $cantidad;
                    break;
                case ("3"):
                    $articulo->dp="P3";
                    $articulo->precio=$parametro->precio3* $cantidad;
                    break;
                case ("4"):
                    $articulo->dp="P4";
                    $articulo->precio=$parametro->precio4* $cantidad;
                    break;
                case ("5"):
                    $articulo->dp="P5";
                    $articulo->precio=$parametro->precio5* $cantidad;
                    break;
                default:
                    $articulo->dp="P1";
                    $articulo->precio=$parametro->precio1* $cantidad;
            }
            /*
            * modifico la existencia al modificar una venta
            */
            if ($this->venta->estado=='t'){
                $existencia = new IAManager($articulo->articulo_id, $this->venta->sucursal_id, $this->venta->almacen_id);
                $existencia->UpdateSale($articulo->cantidad,$cantidad);
            }

            $articulo->cantidad = $cantidad;
            $articulo->save();
        }else{
            $articulo = new  DetalleVentaArticulo();
            $articulo->venta_articulo_id = $this->venta->id;
            $articulo->sucursal_id = $this->venta->sucursal_id;
            $articulo->articulo_id = $articulo_id;
            $articulo->usuario_id = Auth::user()->id;
            $articulo->cantidad = $cantidad;
            switch ($precio){
                case ("1"):
                    $articulo->dp="P1";
                    $articulo->precio=$parametro->precio1* $cantidad;
                    break;
                case ("2"):
                    $articulo->dp="P2";
                    $articulo->precio=$parametro->precio2* $cantidad;
                    break;
                case ("3"):
                    $articulo->dp="P3";
                    $articulo->precio=$parametro->precio3* $cantidad;
                    break;
                case ("4"):
                    $articulo->dp="P4";
                    $articulo->precio=$parametro->precio4* $cantidad;
                    break;
                case ("5"):
                    $articulo->dp="P5";
                    $articulo->precio=$parametro->precio5* $cantidad;
                    break;
                default:
                    $articulo->dp="P1";
                    $articulo->precio=$parametro->precio1* $cantidad;
                    break;
            }
            $articulo->almacen_id = $this->venta->almacen_id;

            $articulo->save();
            if ($this->venta->estado=='t'){
                $existencia = new IAManager($articulo->articulo_id, $this->venta->sucursal_id, $this->venta->almacen_id);
                $existencia->down($cantidad);
            }
        }
    }

    function updateVenta(){
        \DB::table('detalles_ventas_articulos')
            ->where('venta_articulo_id', $this->venta->id)
            ->update(['sucursal_id' => $this->venta->sucursal_id,'almacen_id'=>$this->venta->almacen_id]);
    }


    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Ventas de Articulos Registradas',route('admin.venta_art.index'),'Ventas');
            $this->datos['ventas'] = VentaArticulo::with('cliente','usuario','sucursal','almacen')
                ->fecha($request->get('fecha'))
                ->where('estado','t')
                ->orWhere('estado','c')
                ->codigo($request->get('s'))
                ->sucursal($request->get('sucursal'))
                ->cliente($request->get('cliente'))
                ->cliente($request->get('c'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.venta_art.list',$this->datos);
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
            $this->datos['brand'] = Tool::brand('Registrar una Venta',route('admin.venta_art.index'),'Ventas de Articulos');
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

            return view('cpanel.admin.venta_art.registro',$this->datos);
        }


        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }
    public function confirmVentaArticulo($id, $estado, Request $request)
    {
        $venta = VentaArticulo::find($id);
        if ($estado == 't') {
            $venta->fill($request->all());
            $now=Carbon::now();
            $venta->registro=$now->toDateTimeString();
            $venta->save();
            $venta->almacen_id=$venta->sucursal->almacen->id;
            $venta->estado = 't';
            foreach ($venta->detalleventas as $row) {
                $existencia = new IAManager($row->articulo_id, $venta->sucursal_id, $venta->almacen_id);
                $existencia->down($row->cantidad);
            }
        }
        elseif($estado=='c'){
            if($venta->estado == 't') {
                $articulos = DetalleVentaArticulo::where('venta_articulo_id', $id);
                foreach ($articulos as $art) {
                    $existencia = new IAManager($art->articulo_id, $this->venta->sucursal_id, $this->venta->almacen_id);
                    $existencia->add($art->cantidad);
                }
            }
            $venta->estado='c';
        }
        $venta->save();

        if($venta->tipo_pago=='Credito') {
            $credito = new VentaCreditoArticulo();
            $credito->usuario_id = $venta->usuario_id;
            $credito->venta_articulo_id = $venta->id;
            $credito->abono = $venta->abono;
            $credito->fecha = $venta->registro;
            $credito->save();
        }

        $this->venta = $venta;
        $this->updateVenta();

        /// enviar la url del reporte en la variable tiket
        \Session::flash('tiket',url('reportes/venta').'?id='.$venta->id);
        return redirect()->route('admin.venta_art.index');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){

            //actualizo la compra de ser necesario
            $this->venta->fill($request->all());
            $this->venta->sucursal_id = $request->get('sucursal_id');
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
            $this->datos['razon_social'] = $this->datos['venta']->cliente->razon_social;
            $this->datos['nit'] = $this->datos['venta']->cliente->nit;
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
            $this->venta->cliente_id = $request->get('cliente_id');
            $this->venta->observaciones = $request->get('observaciones');
            $this->venta->sucursal_id = $request->get('sucursal_id');
            $this->venta->save();
            $this->venta->almacen_id = $this->venta->sucursal->almacen->id;
            $this->venta->save();

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
            if($venta->estado == 't') {
                $articulos = DetalleVentaArticulo::where('venta_articulo_id', $id);
                foreach ($articulos as $art) {
                    $existencia = new IAManager($art->articulo_id, $this->venta->sucursal_id, $this->venta->almacen_id);
                    $existencia->add($art->cantidad);
                }
            }
            \DB::table('detalles_ventas_articulos')->where('venta_articulo_id',$venta->id)->delete();
            \DB::table('ventas_credito_articulos')->where('venta_articulo_id',$venta->id)->delete();
            VentaArticulo::destroy($id);
            $mensaje = 'La Venta fue Cancelada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.venta_art.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
