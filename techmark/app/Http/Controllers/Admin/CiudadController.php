<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 22/06/2017
 * Time: 01:15 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CiudadRequest;
use Illuminate\Http\Request;
use App\Tool;
use Illuminate\Support\Facades\Auth;
use App\Ciudad;
use App\Http\Controllers\Controller;

class CiudadController extends Controller
{
    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            if ($request)
            {
                $this->datos['brand'] = Tool::brand('Ciudad',route('admin.ciudad.index'),'Ciudades');
                $this->datos['ciudades'] = Ciudad::name($request->get('s'))
                    ->orderBy('id','desc')
                    ->paginate();
                return view('cpanel.admin.ciudad.list')->with($this->datos);
            }
            else {
                \Session::flash('message', 'No existen registros de esa Ciudad');
            }
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Ciudad',route('admin.ciudad.index'),'Ciudades');
            return view('cpanel.admin.ciudad.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }
    public function store(CiudadRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            $ciudad = new  Ciudad($request->all());
            $ciudad->save();
            return redirect()->route('admin.ciudad.index');
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
            $this->datos['brand'] = Tool::brand('Editar Ciudad',route('admin.ciudad.index'),'Ciudades');
            $this->datos['ciudad'] = Ciudad::find($id);
            return view('cpanel.admin.ciudad.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }

    }
    public function update(CiudadRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $ciudad = Ciudad::find($id);
            $ciudad->fill($request->all());
            $ciudad->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }
    public function destroy($id)
    {

        if(Auth::user()->can('allow-delete')) {
            $ciudad = Ciudad::find($id);
            \Session::flash('user-dead',$ciudad->Nit);
            if(!$ciudad->deleteOk()){
                $mensaje = 'El Almacen  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Ciudad::destroy($id);
                $mensaje = 'El almacen  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.almacen.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }

}