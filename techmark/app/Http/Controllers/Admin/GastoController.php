<?php

namespace App\Http\Controllers\Admin;

use App\Gasto;
use App\Sucursal;
use App\Tool;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GastoController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read'))
        {
            $this->datos['brand'] = Tool::brand('Gastos',route('admin.gasto.index'),'Caja');
            $this->datos['gastos'] = Gasto::with('sucursal','usuario')
                ->fecha($request->get('fecha'))
                ->usuario($request->get('usuario'))
                ->sucursal($request->get('sucursal'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.gasto.list')->with($this->datos);
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    function genDatos(){
        $this->datos['usuarios']=User::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
    }
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->genDatos();
            $this->datos['brand'] = Tool::brand('Agregar Nuevo Gasto',route('admin.gasto.index'),'Gastos');
            return view('cpanel.admin.gasto.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            Gasto::create($request->all());
            return redirect()->route('admin.gasto.index');
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        if(Auth::user()->can('allow-edit')){
            $this->genDatos();
            $this->datos['brand'] = Tool::brand('Editar Gasto',route('admin.gasto.index'),'Gastos');
            $this->datos['gasto'] = Gasto::find($id);
            return view('cpanel.admin.gasto.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $gasto = Gasto::find($id);
            $gasto->fill($request->all());
            $gasto->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->can('allow-delete')) {
            $gasto = Gasto::find($id);
            \Session::flash('gasto-dead',$gasto->descripcion);
            Gasto::destroy($id);
            $mensaje = 'El gasto fue eliminado ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.gasto.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }
    }
}
