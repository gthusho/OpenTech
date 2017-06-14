<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Cliente;
use App\User;
use App\Visita;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Requests\VisitaFormRequest;
use Illuminate\Http\Request;
use App\Tool;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class VisitaController extends Controller
{
    private  $datos = null;

    public function index(Request $request)
    {

       if(Auth::user()->can('allow-read')){

            $this->datos['brand'] = Tool::brand('Visita',route('admin.visita.index'),'Visitas');
            $this->datos['visitas'] = Visita::orderBy('IdVisita','desc')
                ->paginate();
            return view('cpanel.ventas.visitas.list')->with($this->datos);
        }
        else{

            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }

    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Visita',route('admin.visita.index'),'Visitas');
            $this->datos['clientes'] = Cliente::where('Activo',1)->get()->lists('RazonSocial','IdCliente');
            return view('cpanel.ventas.visitas.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }
    public function store(VisitaFormRequest $request)
    {
        if(Auth::user()->can('allow-insert')){

            $visita = new  Visita($request->all());
            $visita->IdUsuario = Auth::user()->IdUsuario;
            $visita->save();

            return redirect()->route('admin.visita.index');
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
            $this->datos['brand'] = Tool::brand('Editar Visita',route('admin.visita.index'),'Visitas');
            $this->datos['visita'] = Visita::find($id);
            $this->datos['clientes'] = Cliente::where('Activo',1)->get()->lists('RazonSocial','IdCliente');
            return view('cpanel.ventas.visitas.edit',$this->datos);
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }


    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $visita = Visita::find($id);
            $visita->fill($request->all());
            $visita->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }


    public function destroy($id)
    {

        if(Auth::user()->can('allow-delete')) {
            Visita::destroy($id);
            \Session::flash('message',"La Visita Fue Eliminada");
            return redirect()->route('admin.visita.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }


    }
}
