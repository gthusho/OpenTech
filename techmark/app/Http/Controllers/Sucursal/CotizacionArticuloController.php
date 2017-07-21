<?php

namespace App\Http\Controllers\Sucursal;

use App\Articulo;
use App\Clientes;
use App\CotizacionArticulo;
use App\DetalleCotizacion;
use App\Http\Controllers\Controller;
use App\Sucursal;
use App\User;
use Illuminate\Http\Request;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class CotizacionArticuloController extends Controller
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
        $query = CotizacionArticulo::where('usuario_id',Auth::user()->id)->where('estado','p')->get();
        if(Tool::existe($query)){
            $this->cotizacion = $query->first();
        }else{
            $user=User::find(Auth::user()->id);
            $this->cotizacion = new  CotizacionArticulo();
            $this->cotizacion->usuario_id = $user->id;
            $this->cotizacion->sucursal_id=$user->sucursal_id;
            $this->cotizacion->save();
        }
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
        $query = DetalleCotizacion::where('cotizacion_id',$this->cotizacion->id)->where('articulo_id',$articulo_id)->get();
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
            $articulo->cotizacion_id = $this->cotizacion->id;
            $articulo->sucursal_id = $this->cotizacion->sucursal_id;
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


    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Cotizaciones Registradas',route('cotizacion.index'),'Cotizaciones');
            $this->datos['cotizaciones'] = CotizacionArticulo::with('cliente','usuario','sucursal')
                ->where('estado','t')
                ->fecha($request->get('fecha'))
                ->codigo($request->get('s'))
                ->usuario(Auth::user()->id)
                ->cliente($request->get('cliente'))
                ->cliente($request->get('c'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
           /* dd($this->datos['ventas']);*/
            return view('cpanel.sucursal.cotizacionarticulo.list',$this->datos);
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
            $this->datos['brand'] = Tool::brand('Registrar una Cotizacion',route('cotizacion.index'),'Cotizacion');
            //mando la compra pre-registrada y/o obtenida en el constructor

            $this->datos['cotizacion'] = $this->cotizacion;

            $this->datos['razon_social'] = null;
            $this->datos['nit'] = null;
            if($this->cotizacion->cliente_id!='' || $this->cotizacion->cliente_id!=0){
                $this->datos['razon_social'] = $this->cotizacion->cliente->razon_social;
                $this->datos['nit'] = $this->cotizacion->cliente->nit;
            }
            $user=User::find(Auth::user()->id);
            $this->datos['sucursal']=$this->cotizacion->sucursal->nombre;
            return view('cpanel.sucursal.cotizacionarticulo.registro',$this->datos);
        }


        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }
    public function confirmCotizacion($id){
        $cotizacion = CotizacionArticulo::find($id);
        $cotizacion->estado = 't';
        $cotizacion->save();
        return redirect()->route('cotizacion.index');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){

            //actualizo la compra de ser necesario
            $this->cotizacion->fill($request->all());
            $this->cotizacion->save();

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
            $user=User::find(Auth::user()->id);
            $this->datos['brand'] = Tool::brand('Editar Cotizacion',route('cotizacion.index'),'Cotizacion');
            $this->datos['cotizacion'] = CotizacionArticulo::find($id);
            $this->datos['razon_social'] = $this->datos['cotizacion']->cliente->razon_social;
            $this->datos['nit'] = $this->datos['cotizacion']->cliente->nit;
            $this->datos['sucursal']=$user->sucursal->nombre;
            return view('cpanel.sucursal.cotizacionarticulo.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }


    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            //actualizo la compra de ser necesario
            $this->cotizacion = CotizacionArticulo::find($id);
            $this->cotizacion->fill($request->all());
            $this->cotizacion->save();


            //valido si me envias un articulo id
            if($request->get('articulo_id')!=''){
                $this->setArticulo($request->get('articulo_id'),$request->get('xCantidad'),$request->get('xPrecio'));
            }


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
            $cotizacion =  CotizacionArticulo::find($id);
            \DB::table('detalles_cotizaciones')->where('cotizacion_id',$cotizacion->id)->delete();
            CotizacionArticulo::destroy($id);
            $mensaje = 'La Cotizacion fue Cancelada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('cotizacion.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
