<?php

namespace App\Http\Controllers\Admin;
use App\Almacen;
use App\Articulo;
use App\Cart;
use App\Compra;
use App\DetalleCotizacion;
use App\Http\Controllers\Controller;
use App\Ingresos;
use App\Proveedor;
use App\Rol;
use App\Sucursal;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DetalleCotAController extends Controller
{
    private  $datos = null;

    public function deleteItemsVentaArticulo($id)
    {
        if(Auth::user()->can('allow-delete')) {
            DetalleCotizacion::destroy($id);
            return redirect()->back();
            //return redirect()->route('admin.compra.create');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }


    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Rol ',route('admin.usuario.index'),'Usuarios & Roles');
            $this->datos['roles'] = Rol::name($request->get('s'))
                ->orderBy('id','desc')
                ->paginate();
            return view('cpanel.admin.rol.list')->with($this->datos);
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
            $this->datos['brand'] = Tool::brand('Editar Rol',route('admin.rol.index'),'Usuarios & Roles');
            return view('cpanel.admin.rol.registro',$this->datos);
        }
        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }


    public function store(Requests\AddRolRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            Rol::create($request->all());
            return redirect()->route('admin.rol.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd(User::find($id));
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar Rol',route('admin.rol.index'),'Usuarios & Roles');
            $this->datos['rol'] = Rol::find($id);
            return view('cpanel.admin.rol.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }


    public function update(Requests\EditRolRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $rol = Rol::find($id);
            $rol->fill($request->all());
            $rol->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(Auth::user()->can('allow-delete')) {
            $rol = Rol::find($id);
            \Session::flash('user-dead',$rol->nombre);
            if(!$rol->deleteOk()){
                $rol->estado=0;
                $rol->save();
                $mensaje = 'El Rol  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito  ';
            }
            else{
                Rol::destroy($id);
                $mensaje = 'El Rol  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.rol.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
    public function deleteItemsCompra($id)
    {
        if(Auth::user()->can('allow-delete')) {
            DetalleCotizacion::destroy($id);
            return redirect()->back();
            //return redirect()->route('admin.compra.create');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
