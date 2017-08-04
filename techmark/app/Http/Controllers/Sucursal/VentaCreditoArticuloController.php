<?php

namespace App\Http\Controllers\Sucursal;

use App\Clientes;
use App\Tool;
use App\VentaArticulo;
use App\VentaCreditoArticulo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VentaCreditoArticuloController extends Controller
{
    private  $datos = null;
    private $permiso = 'venta';
    function __construct()
    {
        $this->middleware('observador:'.$this->permiso);
        $this->middleware('atm', ['except' => 'index']);
        $this->middleware('isCloseatm',['except' => 'index']);
    }

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Ventas al Credito Registradas',route('s.venta-credito-art.index'),'Ventas al Credito');
            $this->datos['ventas'] = VentaArticulo::fecha($request->get('fecha'))
                ->where('estado','t')->where('tipo_pago','Credito')
                ->fecha($request->get('f'))
                ->usuario(Auth::user()->id)
                ->codigo($request->get('s'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.sucursal.venta-credito-art.list',$this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }

    function genDatos(){
        $this->datos['clientes'] = [];

        foreach (Clientes::orderBy('razon_social')->get() as $row)
            $this->datos['clientes'][$row->id] = $row->razon_social .' - '.$row->nit;
    }

    public function show($id)
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Pago Venta Credito',route('s.venta-credito-art.index'),'Ventas al Credito');

            $this->datos['venta'] = VentaArticulo::find($id);

            return view('cpanel.sucursal.venta-credito-art.edit',$this->datos);
        }


        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){

            $abono = new VentaCreditoArticulo($request->all());
            $abono->usuario_id = Auth::user()->id;
            $abono->save();
            return redirect()->back();
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');

    }

    public function destroy($id)
    {

        if(Auth::user()->can('allow-delete')) {
            VentaCreditoArticulo::destroy($id);
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }

}
