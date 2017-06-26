<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 22/06/2017
 * Time: 04:14 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\AddProveedorRequest;
use App\Http\Requests\ClienteRequest;
use App\Http\Requests\EditProveedorRequest;
use App\Http\Requests\ProveedorRequest;
use App\Proveedor;
use Illuminate\Http\Request;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            if ($request)
            {
                $this->datos['brand'] = Tool::brand('Proveedores',route('admin.proveedor.index'),'Proveedores');
                $this->datos['proveedores'] = Proveedor::name($request->get('s'))
                    ->orderBy('id','desc')
                    ->paginate();
                return view('cpanel.admin.proveedor.list')->with($this->datos);
            }
            else {
                \Session::flash('message', 'No existen registros de Proveedores');
            }
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Proveedor',route('admin.proveedor.index'),'Proveedores');
            return view('cpanel.admin.proveedor.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }
    public function store(AddProveedorRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            $proveedor = new  Proveedor($request->all());
            $proveedor->save();
            return redirect()->route('admin.proveedor.index');
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
            $this->datos['brand'] = Tool::brand('Editar Proveedor',route('admin.proveedor.index'),'Proveedores');
            $this->datos['proveedor'] = Proveedor::find($id);
            return view('cpanel.admin.proveedor.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }

    }
    public function update(EditProveedorRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $proveedor = Proveedor::find($id);
            $proveedor->fill($request->all());
            $proveedor->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }
    public function destroy($id)
    {

        if(Auth::user()->can('allow-delete')) {
            $proveedor = Proveedor::find($id);
            \Session::flash('user-dead',$proveedor->nit);
            if(!$proveedor->deleteOk()){
                $mensaje = 'El usuario  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Proveedor::destroy($id);
                $mensaje = 'El usuario  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.cliente.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}