<?php

namespace App\Http\Controllers\Admin;

use App\Almacen;
use App\Articulo;
use App\Clientes;
use App\DetalleProduccion;
use App\DetProduccionCliente;
use App\IAManager;
use App\Produccion;
use App\ProduccionCliente;
use App\Sucursal;
use App\Tool;
use App\Trabajador;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProduccionClienteController extends Controller
{
    private  $datos = null;
    private  $produccion = null;



    /**
     * metodo me devuelve o crea una produccion
     */
    function setProduccion(){
        //estados = t=>terminado , p=>pendiente
        $query = ProduccionCliente::where('usuario_id',Auth::user()->id)->where('estado','p')->get();
        if(Tool::existe($query)){
            $this->produccion = $query->first();
        }else{
            $this->produccion = new  ProduccionCliente();
            $this->produccion->usuario_id = Auth::user()->id;
            $this->produccion->save();
        }
    }



    /**
     * inicializa datos para los combos
     */
    function genDataIni(){
        $this->datos['sucursales'] = Sucursal::where('estado',1)->orderBy('nombre')->get()->lists('nombre','id');
        $this->datos['trabajadores'] = Trabajador::where('estado',1)->orderBy('nombre')->get()->lists('nombre','id');
        $this->datos['clientes'] = Clientes::where('estado',1)->orderBy('razon_social')->get()->lists('razon_social','id');
        $this->datos['almacenes'] = Almacen::where('estado',1)->orderBy('nombre')->get()->lists('nombre','id');
    }


    function setArticulo($articulo_id, $cantidad, $precio){
        $articulo = null;
        $query = DetProduccionCliente::where('produccion_cliente_id',$this->produccion->id)->where('articulo_id',$articulo_id)->get();
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
                default:
                    $articulo->dp="P3";
                    $articulo->precio=$parametro->precio3* $cantidad;
            }
            /*
           * modifico la existencia al modificar una produccion
           */
            if ($this->produccion->estado=='t'){
                $existencia = new IAManager($articulo->articulo_id, $this->produccion->sucursal_id);
                $existencia->UpdateSale($articulo->cantidad,$cantidad);
            }

            $articulo->cantidad = $cantidad;
            $articulo->save();
        }else{
            $articulo = new  DetProduccionCliente();
            $articulo->produccion_cliente_id = $this->produccion->id;
            $articulo->sucursal_id = $this->produccion->sucursal_id;
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
            }
            //$articulo->almacen_id = $this->produccion->almacen_id;

            $articulo->save();
            if ($this->produccion->estado=='t'){
                $existencia = new IAManager($articulo->articulo_id, $this->produccion->sucursal_id);
                $existencia->down($cantidad);
            }
        }
    }

    function updateProduccion(){
        \DB::table('producciones_clientes_detalles')
            ->where('produccion_cliente_id', $this->produccion->id)
            ->update(['sucursal_id' => $this->produccion->sucursal_id/*,'almacen_id'=>$this->produccion->almacen_id*/]);
    }


    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Producciones Para Clientes Registradas',route('admin.clientes.produccion.index'),'Producciones');
            $this->datos['producciones'] = ProduccionCliente::with('trabajador','usuario','sucursal'/*,'almacen'*/)
                //->fecha($request->get('fecha'))
                ->whereIn('estado',['t','c'])
                ->fecha($request->get('fecha'))
                ->cliente($request->get('cliente'))
                ->sucursal($request->get('sucursal'))
                ->trabajador($request->get('trabajador'))
                ->destino($request->get('s'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.produccion_cli.list',$this->datos);
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }
    function genDatos(){
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['trabajadores']=Trabajador::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['clientes'] = [];
        foreach (Clientes::where('estado',1)->orderBy('razon_social')->get() as $row){
            $this->datos['clientes'][$row->id] = $row->razon_social .' | NIT: '.$row->nit;
        }

    }

    public function create()
    {
        $this->setProduccion();
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Registrar una Produccion',route('admin.clientes.produccion.index'),'Producciones');
            //inicializo loscombos
            $this->genDataIni();
            //mando la compra pre-registrada y/o obtenida en el constructor


            $this->datos['produccion'] = $this->produccion;

            return view('cpanel.admin.produccion_cli.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }
    public function confirmProduccion($id,$estado,Request $request){
        $produccion = ProduccionCliente::find($id);
        $produccion->fill($request->all());
        if ($estado=='t') {
            $produccion->estado = 't';
            $produccion->save();
            /*
          * egreso items a existencia una vez terminado la venta
          */
            foreach ($produccion->detalle as $row) {
                $existencia = new IAManager($row->articulo_id, $produccion->sucursal_id, 0);
                $existencia->down($row->cantidad);
            }
        }
        elseif ($estado=='c'){
            $produccion->estado = 'c';
            $produccion->save();
            if ($produccion->estado=='t'){
                foreach ($produccion->detalle as $row) {
                    $existencia = new IAManager($row->articulo_id, $produccion->sucursal_id, 0);
                    $existencia->add($row->cantidad);
                }
            }
        }
        return redirect()->route('admin.clientes.produccion.index');
    }

    public function store(Request $request)
    {
        $this->setProduccion();
        if(Auth::user()->can('allow-insert')){

            //actualizo la compra de ser necesario
            $this->produccion->fill($request->all());
            $fechas=explode('-',$this->produccion->fecha);
            $this->produccion->inicio=$fechas[0];
            $this->produccion->fin=$fechas[1];
            $this->produccion->save();
            //$this->produccion->almacen_id = $this->produccion->sucursal->almacen->id;
            //$this->produccion->save();

            //valido si me envias un articulo id
            if($request->get('articulo_id')!='' && $request->get('xCantidad')!='' && $request->get('xPrecio')!=''){
                $this->setArticulo($request->get('articulo_id'),$request->get('xCantidad'),$request->get('xPrecio'));
            }

            //actualzamos los datos de ingresos con referencia a los cambios en compra si uera necesario


            $this->updateProduccion();


            return redirect()->back();
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }


    public function show($id)
    {
        if(Auth::user()->can('allow-insert')){
            $this->setProduccion();
            $this->datos['brand'] = Tool::brand('Registrar una Produccion',route('admin.clientes.produccion.index'),'Producciones');
            //inicializo loscombos
            $this->genDataIni();
            //mando la compra pre-registrada y/o obtenida en el constructor

            $cot=CotizacionProducto::find($id);
            $cot->estado='a';
            $cot->save();
            $this->produccion->destino=$cot->getDestino();
            $this->produccion->precio=$cot->totalPrecio();
            $this->produccion->cliente_id=$cot->cliente_id;
            $this->produccion->sucursal_id=$cot->sucursal_id;
            $this->produccion->save();

            $this->datos['produccion'] = $this->produccion;

            return view('cpanel.admin.produccion_cli.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }


    public function edit($id)
    {
        $this->setProduccion();
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar Produccion Cliente',route('admin.clientes.produccion.index'),'Producciones');
            $this->genDataIni();
            $this->datos['produccion'] = ProduccionCliente::find($id);
            return view('cpanel.admin.produccion_cli.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }


    public function update(Request $request, $id)
    {
        $this->setProduccion();
        if(Auth::user()->can('allow-edit')){
            //actualizo la compra de ser necesario
            $this->produccion = ProduccionCliente::find($id);
            $this->produccion->fill($request->all());
            $fechas=explode('-',$this->produccion->fecha);
            $this->produccion->inicio=$fechas[0];
            $this->produccion->fin=$fechas[1];
            $this->produccion->save();
            //valido si me envias un articulo id
            if($request->get('articulo_id')!=''){
                $this->setArticulo($request->get('articulo_id'),$request->get('xCantidad'),$request->get('xPrecio'));
            }
            //actualzamos los datos de ingresos con referencia a los cambios en compra si uera necesario
            $this->updateProduccion();
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
            $produccion =  ProduccionCliente::find($id);
            if ($produccion->estado=='t'){
             foreach ($produccion->detalle as $row)
                $existencia = new IAManager($row->articulo_id, $row->sucursal_id);
                $existencia->add($row->cantidad);
            }
            \DB::table('producciones_clientes_detalles')->where('produccion_cliente_id',$produccion->id)->delete();
            ProduccionCliente::destroy($id);
            $mensaje = 'La Produccion fue Eliminada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.clientes.produccion.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }
    }
    function deleteItemsProduccion($id){

        $this->setProduccion();
        $itemProduction = DetProduccionCliente::find($id);
        if ($this->produccion->estado=='t'){
            $existencia = new IAManager($itemProduction->articulo_id, $this->produccion->sucursal_id);
            $existencia->add($itemProduction->cantidad);
        }
        DetProduccionCliente::destroy($id);
        return redirect()->back();
    }

    public function entregar($id)
    {
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Entraga de Produccion Cliente',route('admin.clientes.produccion.index'),'Producciones');
            $this->genDataIni();
            $this->datos['produccion'] = ProduccionCliente::find($id);
            return view('cpanel.admin.produccion_cli.entrega',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }
    public function entregarOk($id, Request $request)
    {
        if(Auth::user()->can('allow-edit')){
            $produccion = ProduccionCliente::find($id);
            $produccion->fill($request->all());
            $produccion->terminado=1;
            $produccion->save();
            return redirect()->route('admin.clientes.produccion.index');
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }
}
