<?php

namespace App\Http\Controllers\Admin;
use App\Almacen;
use App\Articulo;
use App\Cart;
use App\Compra;
use App\Http\Controllers\Controller;
use App\IAManager;
use App\Ingresos;
use App\Proveedor;
use App\Rol;
use App\Sucursal;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ComprasController extends Controller
{

    private  $datos = null;
    private  $compra = null;

    function __construct()
    {
        $this->setVenta();
    }

    /**
     * metodo me devuelve o crea una venta
     */
    function setVenta(){
        //estados = t=>terminado , p=>pendiente
        $query = Compra::where('usuario_id',Auth::user()->id)->where('estado','p')->get();
        if(Tool::existe($query)){
            $this->compra = $query->first();
        }else{
            $this->compra = new  Compra();
            $this->compra->usuario_id = Auth::user()->id;
            $this->compra->save();
        }
    }



    /**
     * inicializa datos para los combos
     */
    function genDataIni(){
        $this->datos['sucursales'] = Sucursal::where('estado',1)->orderBy('nombre')->get()->lists('nombre','id');
        $this->datos['almacenes'] = Almacen::where('estado',1)->orderBy('nombre')->get()->lists('nombre','id');
        $this->datos['proveedores'] = Proveedor::where('estado',1)->orderBy('razon_social')->get()->lists('razon_social','id');
    }


    /**
     * @param $articulo
     * @param $cantidad
     * @param $costo
     */
    function setArticulo($articulo_id, $cantidad, $costo){
        $articulo = null;
        $query = Ingresos::where('compra_id',$this->compra->id)->where('articulo_id',$articulo_id)->get();
        if(Tool::existe($query)){
            $articulo = $query->first();
            /*
            * ingreso items a existencia una vez terminado la compra
             */
            if ($this->compra->estado=='t'){
                $existencia = new IAManager($articulo->articulo_id, $this->compra->sucursal_id, $this->compra->almacen_id);
                $existencia->UpdatePurchase($articulo->cantidad,$cantidad);
            }
            $articulo->cantidad = $cantidad;
            $articulo->costo = $costo;
            $articulo->save();
        }else{
            $articulo = new  Ingresos();
            $articulo->compra_id = $this->compra->id;
            $articulo->sucursal_id = $this->compra->sucursal_id;
            $articulo->almacen_id = $this->compra->almacen_id;
            $articulo->articulo_id = $articulo_id;
            $articulo->usuario_id = Auth::user()->id;
            $articulo->cantidad = $cantidad;
            $articulo->costo = $costo;
            if ($this->compra->estado=='t'){
                $existencia = new IAManager($articulo->articulo_id, $this->compra->sucursal_id, $this->compra->almacen_id);
                $existencia->add($cantidad);
            }
            $articulo->save();
        }
    }

    function updateCompra(){
        \DB::table('ingresos')
            ->where('compra_id', $this->compra->id)
            ->update(['sucursal_id' => $this->compra->sucursal_id,'almacen_id'=>$this->compra->almacen_id]);
    }



    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Compras Registradas',route('admin.compra.index'),'Compras');
            $this->datos['compras'] = Compra::with('sucursal','proveedor')
                ->fecha($request->get('fecha'))
                ->where('estado','t')
                ->fecha($request->get('f'))
                ->codigo($request->get('s'))
                ->sucursal($request->get('sucursal'))
                ->proveedor($request->get('proveedor'))
                ->orderBy('fecha','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.compra.list',$this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
    function genDatos(){
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['proveedores']=Proveedor::where('estado',true)->orderBy('razon_social')->pluck('razon_social','id');
    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Registrar una Compra',route('admin.compra.index'),'Compras');
            //inicializo loscombos
            $this->genDataIni();
            //mando la compra pre-registrada y/o obtenida en el constructor

            $this->datos['compra'] = $this->compra;

            return view('cpanel.admin.compra.registro',$this->datos);
        }


        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }
    public function confirmCompra($id){
        $compra = Compra::find($id);
        $compra->estado = 't';
        $compra->save();

        /*
         * ingreso items a existencia una vez terminado la compra
         */

        foreach ($compra->articulos as $row){
            $existencia = new IAManager($row->articulo_id, $compra->sucursal_id, $compra->almacen_id);
            $existencia->add($row->cantidad);
        }




        return redirect()->route('admin.compra.index');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){

            //actualizo la compra de ser necesario
            $this->compra->fill($request->all());
            $this->compra->save();
            $this->compra->almacen_id = $this->compra->sucursal->almacen->id;
            $this->compra->save();


            //valido si me envias un articulo id
            if($request->get('articulo_id')!='' && $request->get('xCantidad')!=''){
                $this->setArticulo($request->get('articulo_id'),$request->get('xCantidad'),$request->get('xCosto'));



            }

            //actualzamos los datos de ingresos con referencia a los cambios en compra si uera necesario

            $this->updateCompra();


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
            $this->datos['brand'] = Tool::brand('Editar Compra',route('admin.compra.index'),'Compras');
            $this->genDataIni();
            $this->datos['compra'] = Compra::find($id);
            return view('cpanel.admin.compra.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }


    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            //actualizo la compra de ser necesario
            $this->compra = Compra::find($id);
            $this->compra->fill($request->all());
            $this->compra->save();
            $this->compra->almacen_id = $this->compra->sucursal->almacen->id;
            $this->compra->save();


            //valido si me envias un articulo id
            if($request->get('articulo_id')!=''){
                $this->setArticulo($request->get('articulo_id'),$request->get('xCantidad'),$request->get('xCosto'));
            }


            //actualzamos los datos de ingresos con referencia a los cambios en compra si uera necesario

            $this->updateCompra();


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
            $compra =  Compra::find($id);
            \DB::table('ingresos')->where('compra_id',$compra->id)->delete();
            Compra::destroy($id);
            $mensaje = 'La Compra fue Cancelada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.compra.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
