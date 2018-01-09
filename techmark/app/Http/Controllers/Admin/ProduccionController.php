<?php

namespace App\Http\Controllers\Admin;

use App\Almacen;
use App\Articulo;
use App\DetalleProduccion;
use App\IAManager;
use App\Produccion;
use App\Sucursal;
use App\Tool;
use App\Trabajador;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProduccionController extends Controller
{
    private  $datos = null;
    private  $produccion = null;

    function __construct()
    {
        $this->setProduccion();
    }

    /**
     * metodo me devuelve o crea una produccion
     */
    function setProduccion(){
        //estados = t=>terminado , p=>pendiente
        $query = Produccion::where('usuario_id',Auth::user()->id)->where('estado','p')->get();
        if(Tool::existe($query)){
            $this->produccion = $query->first();
        }else{
            $this->produccion = new  Produccion();
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
        $this->datos['almacenes'] = Almacen::where('estado',1)->orderBy('nombre')->get()->lists('nombre','id');
    }


    function setArticulo($articulo_id, $cantidad, $precio){
        $articulo = null;
        $query = DetalleProduccion::where('produccion_id',$this->produccion->id)->where('articulo_id',$articulo_id)->get();
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
            $articulo = new  DetalleProduccion();
            $articulo->produccion_id = $this->produccion->id;
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
        \DB::table('detalles_producciones')
            ->where('produccion_id', $this->produccion->id)
            ->update(['sucursal_id' => $this->produccion->sucursal_id/*,'almacen_id'=>$this->produccion->almacen_id*/]);
    }


    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Producciones Registradas',route('admin.produccion.index'),'Producciones');
            $this->datos['producciones'] = Produccion::with('trabajador','usuario','sucursal'/*,'almacen'*/)
                ->whereIn('estado',['t','c'])
                ->fecha($request->get('fecha'))
                ->sucursal($request->get('sucursal'))
                ->trabajador($request->get('trabajador'))
                ->destino($request->get('s'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.produccion.list',$this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
    function genDatos(){
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['trabajadores']=Trabajador::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Registrar una Produccion',route('admin.produccion.index'),'Producciones');
            //inicializo loscombos
            $this->genDataIni();
            //mando la compra pre-registrada y/o obtenida en el constructor


            $this->datos['produccion'] = $this->produccion;

            return view('cpanel.admin.produccion.registro',$this->datos);
        }


        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }
    public function confirmProduccion($id){
        $produccion = Produccion::find($id);
        $produccion->estado = 't';
        $produccion->save();
        /*
      * egreso items a existencia una vez terminado la venta
      */
        foreach ($produccion->detalle as $row){
            $existencia = new IAManager($row->articulo_id, $produccion->sucursal_id, 0);
            $existencia->down($row->cantidad);
        }
        return redirect()->route('admin.produccion.index');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){

            //actualizo la compra de ser necesario
            $this->produccion->fill($request->all());
            $this->produccion->sucursal_id = $request->get('sucursal_id');
            $this->produccion->trabajador_id = $request->get('trabajador_id');
            $this->produccion->destino=$request->get('destino');
            $this->produccion->fecha=$request->get('fecha');
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
            $this->datos['brand'] = Tool::brand('Editar Produccion',route('admin.produccion.index'),'Producciones');
            $this->genDataIni();
            $this->datos['produccion'] = Produccion::find($id);
            return view('cpanel.admin.produccion.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }


    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            //actualizo la compra de ser necesario
            $this->produccion = Produccion::find($id);
            $this->produccion->trabajador_id = $request->get('trabajador_id');
            $this->produccion->destino = $request->get('destino');
            $this->produccion->fecha = $request->get('fecha');
            $fechas=explode('-',$this->produccion->fecha);
            $this->produccion->inicio=$fechas[0];
            $this->produccion->fin=$fechas[1];
            $this->produccion->sucursal_id = $request->get('sucursal_id');
            $this->produccion->save();
            //$this->produccion->almacen_id = $this->produccion->sucursal->almacen->id;
            //$this->produccion->save();


            //valido si me envias un articulo id
            if($request->get('articulo_id')!=''){
                $this->setArticulo($request->get('articulo_id'),$request->get('xCantidad'),$request->get('xPrecio'));
            }

            //actualzamos los datos de ingresos con referencia a los cambios en compra si uera necesario

            $this->updateProduccion();


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
            $produccion =  Produccion::find($id);
            \DB::table('detalles_producciones')->where('produccion_id',$produccion->id)->delete();
            Produccion::destroy($id);
            $mensaje = 'La Produccion fue Cancelada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.produccion.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
