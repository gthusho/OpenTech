<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\TipoArticuloFormRequest;
use App\Http\Controllers\Controller;
use App\TipoArticulo;
use App\Tool;

use DB;

class TipoArticuloController extends Controller
{
    private $datos=null;
    public function index(Request $request)
    {
    	if(Auth::user()->can('allow-read'))
    	{
	    		$this->datos['brand'] = Tool::brand('Tipo Articulos',route('admin.tipoarticulo.index'),'Almacen');
	    		$this->datos['tipoarticulos'] = TipoArticulo::name($request->get('s'))
	    		->orderBy('IdTipoArticulo','desc')
	    		->paginate();
	    		return view('cpanel.almacen.tipoarticulo.list')->with($this->datos);
    	}
    else {
        \Session::flash('message', 'No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }
    }

    public function create()
    {
    	if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Tipo de Articulo',route('admin.tipoarticulo.index'),'Almacen');
            return view('cpanel.almacen.tipoarticulo.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(Request $request)
    {
    	if(Auth::user()->can('allow-insert')){
            TipoArticulo::create($request->all());
            return redirect()->route('admin.tipoarticulo.index');
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
            $this->datos['brand'] = Tool::brand('Editar Tipo de Articulo',route('admin.tipoarticulo.index'),'Almacen');
            $this->datos['tipoarticulo'] = TipoArticulo::find($id);
            return view('cpanel.almacen.tipoarticulo.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(Request $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $tipoarticulo = TipoArticulo::find($id);
            $tipoarticulo->fill($request->all());
            $tipoarticulo->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $tipoarticulo = TipoArticulo::find($id);
            \Session::flash('tipoarticulo-dead',$tipoarticulo->Descripcion);
            if(!$tipoarticulo->deleteOk()){
                $tipoarticulo->Activo=0;
                $tipoarticulo->save();
                $mensaje = 'El usuario  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                TipoArticulo::destroy($id);
                $mensaje = 'El usuario  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.tipoarticulo.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }}
