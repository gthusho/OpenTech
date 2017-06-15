<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\FamiliaFormRequest;
use App\Http\Controllers\Controller;
use App\Familia;
use App\Tool;

use Carbon\Carbon;

use DB;

class FamiliaController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Familia',route('admin.familia.index'),'Almacen');
            $this->datos['familias'] =Familia::name($request->get('s'))
                ->orderBy('IdFamilia','desc')
                ->paginate();
            return view('cpanel.almacen.familia.list')->with($this->datos);
        }
    else{

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Familias',route('admin.familia.index'),'Almacen');
            return view('cpanel.almacen.familia.registro',$this->datos);
        }
        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            familia::create($request->all());
            return redirect()->route('admin.familia.index');
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
            $this->datos['brand'] = Tool::brand('Editar Familia',route('admin.familia.index'),'Almacen');
            $this->datos['familia'] = Familia::find($id);
            return view('cpanel.almacen.familia.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(Request $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $familia = Familia::find($id);
            $familia->fill($request->all());
            $familia->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }


    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $familia = Familia::find($id);
            \Session::flash('familia-dead',$familia->Descripcion);
            if(!$familia->deleteOk()){
                $familia->Activo=0;
                $familia->save();
                $mensaje = 'La familia que intenta eliminar tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Familia ';
            }
            else{
                Familia::destroy($id);
                $mensaje = 'La Familia fue eliminada ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.familia.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }


}