<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Cliente;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteFormRequest;
use Illuminate\Http\Request;
use App\Tool;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class ClienteController extends Controller
{
    private  $datos = null;

    public function _construct()
    {

    }

 
    public function index(Request $request)
    {

       if(Auth::user()->can('allow-read')){
        if ($request)
            {
            $this->datos['brand'] = Tool::brand('Clientes',route('admin.cliente.index'),'Clientes');
            $this->datos['clientes'] = Cliente::where('Activo',1)
                ->name($request->get('s'))
                ->orderBy('IdCliente','desc')
                ->paginate();
            return view('cpanel.ventas.clientes.list')->with($this->datos);
        }
        \Session::flash('message','No existen registros de clientes');
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Clientes',route('admin.cliente.index'),'Clientes');
            return view('cpanel.ventas.clientes.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }
    public function store(ClienteFormRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            $usu=Auth::user();
            $request['IdUsuario']=$usu->can('allow-read');
            $tiempo=Carbon::now('America/La_Paz');
            $request['FechaModificacion']=$tiempo->toDateTimeString();
            if(Input::hasFile('Foto'))
            {
                $file=Input::file('Foto');
                $file->move(public_path().'/imagenes/clientes/',$file->getClientOriginalName());
                $request['Foto']=$file->getClientOriginalName();

            }
            Cliente::create($request->all());
            return redirect()->route('admin.cliente.index');
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar cliente',route('admin.cliente.index'),'Cliente');
            $this->datos['cliente'] = Cliente::find($id);
            return view('cpanel.ventas.clientes.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }

    }


    public function update(ClienteFormRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $cliente = Cliente::find($id);
            $tiempo=Carbon::now('America/La_Paz');
            $cliente['FechaModificacion']=$tiempo->toDateTimeString();
            $usu=Auth::user();
            $cliente['IdUsuario']=$usu->can('allow-read');

            if(Input::hasFile('Foto'))
            {
                $file=Input::file('Foto');
                $file->move(public_path().'/imagenes/clientes/',$file->getClientOriginalName());
                $cliente['Foto']=$file->getClientOriginalName();

            }
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
            $cliente = Cliente::find($id);
            \Session::flash('user-dead',$cliente->Nit);
            if(!$cliente->deleteOk()){
                $mensaje = 'El usuario  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Cliente::destroy($id);
                $mensaje = 'El usuario  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.cliente.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
