<?php

namespace App\Http\Controllers\Sucursal;

use App\Clientes;
use App\Tool;
use App\VisitaCotizacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VisitaCotizacionController extends Controller
{
    private $datos=null;
    private $permiso = 'visita';

    function __construct()
    {
        $this->middleware('observador:'.$this->permiso);
    }

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read'))
        {
            $this->datos['brand'] = Tool::brand('Visitas Realizadas',route('s.visita.index'),'Medidas');
            $this->datos['visitas'] = VisitaCotizacion::with('cliente')
                ->cliente($request->get('cliente'))
                ->fecha($request->get('fecha'))
                ->direccion($request->get('type'),$request->get('s'))
                ->orderBy('registro','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.sucursal.medida.list')->with($this->datos);
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    function genDatos(){
        $this->datos['clientes']=Clientes::where('estado',true)->pluck('razon_social','id');
    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Registrar Nueva Visita',route('s.visita.index'),'Visitas');
            $this->genDatos();
            return view('cpanel.sucursal.medida.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            $visita = new VisitaCotizacion($request->all());
            $visita->usuario_id= Auth::user()->id;
            $visita->save();
            return redirect()->route('s.visita.index');
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
            $this->datos['brand'] = Tool::brand('Editar Visita',route('s.visita.index'),'Visitas');
            $this->datos['visita'] = VisitaCotizacion::find($id);
            $this->genDatos();
            return view('cpanel.sucursal.medida.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $visita = VisitaCotizacion::find($id);
            $visita->fill($request->all());
            $visita->usuario_id=Auth::user()->id;
            $visita->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar informacion ');
        return redirect('dashboard');
    }
}