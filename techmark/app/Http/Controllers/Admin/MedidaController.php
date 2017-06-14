<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\MedidaFormRequest;
use App\Http\Controllers\Controller;
use App\Medida;
use App\Tool;

use Carbon\Carbon;

use DB;

class MedidaController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read')){
	    		$this->datos['brand'] = Tool::brand('Medidas',route('admin.medida.index'),'Almacen');
	    		$this->datos['medidas'] = Medida::name($request->get('s'))
	    		->orderBy('IdMedida','desc')
	    		->paginate();
	    		return view('cpanel.almacen.medida.list')->with($this->datos);
    	}
        else {
            \Session::flash('message', 'No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }

    public function create()
    {
    	if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Medidas',route('admin.medida.index'),'Almacen');
            return view('cpanel.almacen.medida.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(Request $request)
    {
    	if(Auth::user()->can('allow-insert')){
            Medida::create($request->all());
            return redirect()->route('admin.medida.index');
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
            $this->datos['brand'] = Tool::brand('Editar Medida',route('admin.medida.index'),'Almacen');
            $this->datos['medida'] = Medida::find($id);
            return view('cpanel.almacen.medida.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(MedidaFormRequest $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $medida = Medida::find($id);
            $medida->fill($request->all());
            $medida->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $medida = Medida::find($id);
            \Session::flash('medida-dead',$medida->Descripcion);
            if(!$medida->deleteOk()){
                $medida->Activo=0;
                $medida->save();
                $mensaje = 'El usuario  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Medida::destroy($id);
                $mensaje = 'El usuario  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.medida.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }}
