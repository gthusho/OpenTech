<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 22/06/2017
 * Time: 08:51 AM
 */

namespace App\Http\Controllers\Admin;


use App\Clientes;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddClienteRequest;
use App\Http\Requests\ClienteRequest;
use App\Http\Requests\EditCiudadRequest;
use App\Http\Requests\EditClienteRequest;
use Illuminate\Http\Request;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            if ($request)
            {
                $this->datos['brand'] = Tool::brand('Clientes',route('admin.cliente.index'),'Clientes');
                $this->datos['clientes'] = Clientes::name($request->get('s'))
                    ->orderBy('id','desc')
                    ->paginate();
                return view('cpanel.admin.cliente.list')->with($this->datos);
            }
            else {
                \Session::flash('message', 'No existen registros de clientes');
            }
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Clientes',route('admin.cliente.index'),'Clientes');
            return view('cpanel.admin.cliente.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }
    public function store(AddClienteRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            if($request->ajax()){
                $combo = "";
                foreach (Clientes::where('estado',1)->get() as $row)
                {
                    $combo.="<option value='{$row->id}'>{$row->razon_social}</option>";
                }
                $cliente = new  Clientes($request->all());
                $cliente->save();
                $combo.="<option value='{$cliente->id}' selected>{$cliente->razon_social}</option>";
                echo $combo;
                exit;
            }else {
                $cliente = new  Clientes($request->all());
                $cliente->save();
                return redirect()->route('admin.cliente.index');
            }
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
            $this->datos['brand'] = Tool::brand('Editar cliente',route('admin.cliente.index'),'Cliente');
            $this->datos['cliente'] = Clientes::find($id);
            return view('cpanel.admin.cliente.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }

    }
    public function update(EditClienteRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $cliente = Clientes::find($id);
            $cliente->fill($request->all());
            $cliente->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }
    public function destroy($id)
    {

        if(Auth::user()->can('allow-delete')) {
            $cliente = Clientes::find($id);
            \Session::flash('user-dead',$cliente->Nit);
            if(!$cliente->deleteOk()){
                $mensaje = 'El usuario  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Clientes::destroy($id);
                $mensaje = 'El usuario  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.cliente.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }



}