<?php

namespace App\Http\Controllers\Sucursal;
use App\Articulo;
use App\Caja;
use App\Clientes;
use App\DetalleVentaArticulo;
use App\Http\Controllers\Controller;
use App\IAManager;
use App\Rol;
use App\User;
use App\VentaArticulo;
use App\VentaCreditoArticulo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class VentaArticuloController extends Controller
{

    private  $datos = null;
    private  $venta = null;
    private $permiso = 'venta';

    function __construct()
    {
        $this->middleware('observador:'.$this->permiso);
        $this->middleware('atm', ['except' => 'index']);
        $this->middleware('isCloseatm',['except' => 'index']);
        $this->setVenta();
    }

    function setVenta(){
        //estados = t=>terminado , p=>pendiente
        $query = VentaArticulo::where('usuario_id',Auth::user()->id)->where('estado','p')->get();
        if(Tool::existe($query)){
            $this->venta = $query->first();
        }else{
            $this->venta = new  VentaArticulo();
            $this->venta->usuario_id = Auth::user()->id;
            $this->venta->sucursal_id=Auth::user()->sucursal_id;
            $this->venta->save();
            $this->venta->almacen_id=$this->venta->sucursal->almacen->id;
            $this->venta->save();
        }
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
                case ("2"):
                    $articulo->dp="P2";
                    $articulo->precio=$parametro->precio2* $cantidad;
                    break;
                case ("3"):
                    $articulo->dp="P3";
                    $articulo->precio=$parametro->precio3* $cantidad;
                    break;
                case ("4"):
                    $articulo->dp="P2";
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

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Ventas de Articulos Registradas',route('s.venta_art.index'),'Ventas');
            $this->datos['ventas'] = VentaArticulo::with('cliente','usuario','sucursal','almacen')
                ->fecha($request->get('fecha'))
                ->where('estado','t')
                ->orWhere('estado','c')
                ->codigo($request->get('s'))
                ->usuario(Auth::user()->id)
                ->cliente($request->get('cliente'))
                ->cliente($request->get('c'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.sucursal.venta_art.list',$this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
    function genDatos(){
        $this->datos['clientes'] = [];

        foreach (Clientes::orderBy('razon_social')->get() as $row)
            $this->datos['clientes'][$row->id] = $row->razon_social .' - '.$row->nit;
    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Registrar una Venta',route('s.venta_art.index'),'Ventas de Articulos');
            //mando la compra pre-registrada y/o obtenida en el constructor

            $this->datos['razon_social'] = null;
            $this->datos['nit'] = null;
            if($this->venta->cliente_id!='' || $this->venta->cliente_id!=0){
                $this->datos['razon_social'] = $this->venta->cliente->razon_social;
                $this->datos['nit'] = $this->venta->cliente->nit;
            }

            $this->datos['sucursal']=$this->venta->sucursal->nombre;

            $this->datos['venta'] = $this->venta;

            return view('cpanel.sucursal.venta_art.registro',$this->datos);
        }


        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }
    public function confirmVenta($id, Request $request){
        $venta = VentaArticulo::find($id);
        $venta->fill($request->all());
        $venta->estado = 't';
        $venta->save();
        if($venta->tipo_pago=='Credito') {
            $credito = new VentaCreditoArticulo();
            $credito->usuario_id = $venta->usuario_id;
            $credito->venta_articulo_id = $venta->id;
            $credito->abono = $venta->abono;
            $credito->fecha = $venta->registro;
            $credito->save();
        }
        /*
       * egreso items a existencia una vez terminado la venta
       */
        foreach ($venta->detalleventas as $row){
            $existencia = new IAManager($row->articulo_id, $venta->sucursal_id, $venta->almacen_id);
            $existencia->down($row->cantidad);
        }
        return redirect()->route('s.venta_art.index');
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
            $this->datos['brand'] = Tool::brand('Editar Venta',route('s.venta_art.index'),'Venta de Articulos');
            $this->datos['venta'] = VentaArticulo::find($id);
            $this->datos['razon_social'] = $this->datos['venta']->cliente->razon_social;
            $this->datos['nit'] = $this->datos['venta']->cliente->nit;
            $this->datos['sucursal']=$this->datos['venta']->sucursal->nombre;
            return view('cpanel.sucursal.venta_art.edit',$this->datos);
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
            $this->venta->tipo_pago = $request->get('tipo_pago');
            $this->venta->observaciones = $request->get('observaciones');


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
            $anulado=VentaArticulo::find($id);
            if($anulado->estado == 't') {
                $articulos = DetalleVentaArticulo::where('venta_articulo_id', $id);
                foreach ($articulos as $art) {
                    $existencia = new IAManager($art->articulo_id, $this->venta->sucursal_id, $this->venta->almacen_id);
                    $existencia->add($art->cantidad);
                }
            }
            $anulado->estado='c';
            $anulado->save();
            $mensaje = 'La Venta fue Anulada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('s.venta_art.index');
        }
        \Session::flash('message','No tienes Permisos para eliminar ');
        return redirect('dashboard');

    }
}
