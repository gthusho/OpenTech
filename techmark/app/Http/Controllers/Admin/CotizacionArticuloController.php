<?php

namespace App\Http\Controllers\Admin;

use App\Articulo;
use App\Clientes;
use App\CotizacionArticulo;
use App\DetalleCotizacion;
use App\Http\Controllers\Controller;
use App\Sucursal;
use Illuminate\Http\Request;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class CotizacionArticuloController extends Controller
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
        $query = CotizacionArticulo::where('usuario_id',Auth::user()->id)->where('estado','p')->get();
        if(Tool::existe($query)){
            $this->venta = $query->first();
        }else{
            $this->venta = new  CotizacionArticulo();
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

    /**
     * metodo para el ajax del buscador codigo o codigo barra
     * @param Request $request
     * @return array
     */
    public function getArticuloCotizacion(Request $request){
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

    public function getClienteCotizacion(Request $request){
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


    }

    /**
     * @param $articulo
     * @param $cantidad
     * @param $costo
     */
    function setArticulo($articulo_id, $cantidad, $precio){
        $articulo = null;
        $query = DetalleCotizacion::where('cotizacion_id',$this->venta->id)->where('articulo_id',$articulo_id)->get();
        $parametro=Articulo::where('id',$articulo_id)->get()->first();
        if(Tool::existe($query)){
            $articulo = $query->first();
            switch ($precio){
                case ("1"):
                    $articulo->dp="P1";
                    $articulo->precio=$parametro->precio1 * $cantidad;
                    break;
                case ("2"):
                    $articulo->dp="P2";
                    $articulo->precio=$parametro->precio2* $cantidad;
                    break;
                default:
                    $articulo->dp="P3";
                    $articulo->precio=$parametro->precio3* $cantidad;
            }
            $articulo->cantidad = $cantidad;
            $articulo->save();
        }else{
            $articulo = new  DetalleCotizacion();
            $articulo->cotizacion_id = $this->venta->id;
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
                    $articulo->precio=$parametro->precio2 * $cantidad;
                    break;
                case ("3"):
                    $articulo->dp="P3";
                    $articulo->precio=$parametro->precio3 * $cantidad;
                    break;
            }

            $articulo->save();
        }
    }

    function updateCotizacion(){
        \DB::table('detalles_cotizaciones')
            ->where('cotizacion_id', $this->venta->id)
            ->update(['sucursal_id' => $this->venta->sucursal_id]);
    }


    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Cotizaciones Registradas',route('admin.cotizacion.index'),'Cotizaciones');
            $this->datos['ventas'] = CotizacionArticulo::with('cliente','usuario','sucursal')
                ->where('estado','t')
                ->fecha($request->get('fecha'))
                ->codigo($request->get('s'))
                ->sucursal($request->get('sucursal'))
                ->cliente($request->get('cliente'))
                ->cliente($request->get('c'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
           /* dd($this->datos['ventas']);*/
            return view('cpanel.admin.cotizacionarticulo.list',$this->datos);
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
            $this->datos['brand'] = Tool::brand('Registrar una Cotizacion',route('admin.cotizacion.index'),'Cotizacion');
            //inicializo loscombos
            $this->genDataIni();
            //mando la compra pre-registrada y/o obtenida en el constructor

            $this->datos['venta'] = $this->venta;

            $this->datos['razon_social'] = null;
            $this->datos['nit'] = null;
            if($this->venta->cliente_id!='' || $this->venta->cliente_id!=0){
                $this->datos['razon_social'] = $this->venta->cliente->razon_social;
                $this->datos['nit'] = $this->venta->cliente->nit;
            }
            return view('cpanel.admin.cotizacionarticulo.registro',$this->datos);
        }


        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }
    public function confirmCotizacion($id){
        $venta = CotizacionArticulo::find($id);
        $venta->estado = 't';
        $venta->save();
        return redirect()->route('admin.cotizacion.index');
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
            $this->datos['brand'] = Tool::brand('Editar Cotizacion',route('admin.cotizacion.index'),'Cotizacion');
            $this->genDataIni();
            $this->datos['venta'] = CotizacionArticulo::find($id);
            $this->datos['razon_social'] = $this->datos['venta']->cliente->razon_social;
            $this->datos['nit'] = $this->datos['venta']->cliente->nit;
            return view('cpanel.admin.cotizacionarticulo.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }


    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            //actualizo la compra de ser necesario
            $this->venta = CotizacionArticulo::find($id);
            $this->venta->fill($request->all());
            $this->venta->save();


            //valido si me envias un articulo id
            if($request->get('articulo_id')!=''){
                $this->setArticulo($request->get('articulo_id'),$request->get('xCantidad'),$request->get('xPrecio'));
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
            $venta =  CotizacionArticulo::find($id);
            \DB::table('detalles_cotizaciones')->where('cotizacion_id',$venta->id)->delete();
            CotizacionArticulo::destroy($id);
            $mensaje = 'La Cotizacion fue Cancelada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.cotizacion.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
