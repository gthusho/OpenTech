<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\MarcaFormRequest;
use App\Http\Controllers\Controller;
use App\Marca;
use App\Tool;

use Carbon\Carbon;

use DB;

class MarcaController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {
    	if(Auth::user()->can('allow-read'))
    	{
	    		$this->datos['brand'] = Tool::brand('Marca',route('admin.marca.index'),'Almacen');
	    		$this->datos['marcas'] = Marca::name($request->get('s'))
	    		->orderBy('IdMarca','desc')
	    		->paginate();
	    		return view('cpanel.almacen.marca.list')->with($this->datos);
    	}
        else {
            \Session::flash('message', 'No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }

    public function create()
    {
    	if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Marca',route('admin.marca.index'),'Almacen');
            return view('cpanel.almacen.marca.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(Request $request)
    {
    	if(Auth::user()->can('allow-insert')){
            Marca::create($request->all());
            return redirect()->route('admin.marca.index');
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
            $this->datos['brand'] = Tool::brand('Editar Marca',route('admin.marca.index'),'Marcas');
            $this->datos['marca'] = Marca::find($id);
            return view('cpanel.almacen.marca.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(Request $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $marca = Marca::find($id);
            $marca->fill($request->all());
            $marca->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $marca = Marca::find($id);
            \Session::flash('marca-dead',$marca->Descripcion);
            if(!$marca->deleteOk()){
                $marca->Activo=0;
                $marca->save();
                $mensaje = 'El usuario  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Marca::destroy($id);
                $mensaje = 'El usuario  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.marca.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }}
