<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 22/06/2017
 * Time: 01:04 PM
 */

namespace App\Http\Controllers\Admin;

use App\Ciudad;
use App\Http\Requests\AlmacenRequest;
use Illuminate\Http\Request;
use App\Tool;
use Illuminate\Support\Facades\Auth;
use App\Almacen;
use App\Http\Controllers\Controller;

class AlmacenController extends Controller
{
    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            if ($request)
            {
                $this->datos['brand'] = Tool::brand('Almacen',route('admin.almacen.index'),'Almacenes');
                $this->datos['almacenes'] = Almacen::name($request->get('s'))
                    ->orderBy('id','desc')
                    ->paginate();
                return view('cpanel.admin.almacen.list')->with($this->datos);
            }
            else {
                \Session::flash('message', 'No existen registros de ese almacen');
            }
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Almacen',route('admin.almacen.index'),'Almacenes');
            $this->datos['ciudades'] = Ciudad::where('estado',1)->get()->lists('nombre','id');
            return view('cpanel.admin.almacen.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }
    public function store(AlmacenRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            $almacen = new  Almacen($request->all());
            $almacen->save();
            return redirect()->route('admin.almacen.index');
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
            $this->datos['brand'] = Tool::brand('Editar Almacen',route('admin.almacen.index'),'Almacenes');
            $this->datos['almacen'] = Almacen::find($id);
            $this->datos['ciudades'] = Ciudad::where('estado',1)->get()->lists('nombre','id');
            return view('cpanel.admin.almacen.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }

    }
    public function update(AlmacenRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $almacen = Almacen::find($id);
            $almacen->fill($request->all());
            $almacen->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }
    public function destroy($id)
    {

        if(Auth::user()->can('allow-delete')) {
            $almacen = Almacen::find($id);
            \Session::flash('user-dead',$almacen->Nit);
            if(!$almacen->deleteOk()){
                $mensaje = 'El Almacen  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Almacen::destroy($id);
                $mensaje = 'El almacen  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.almacen.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }

}