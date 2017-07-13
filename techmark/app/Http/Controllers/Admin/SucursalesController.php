<?php

namespace App\Http\Controllers\Admin;
use App\Almacen;
use App\AlmacenSucursal;
use App\Ciudad;
use App\Http\Controllers\Controller;
use App\Rol;
use App\Sucursal;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class SucursalesController extends Controller
{

    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Listado de Sucursales ',route('admin.sucursal.index'),'Sucursales');
            $this->datos['sucursales'] = Sucursal::sucursal($request->get('sucursal'))
                ->sucursal($request->get('s'))
                ->orderBy('id','desc')
                ->paginate();
            return view('cpanel.admin.sucursal.list')->with($this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }


    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Agregar Sucursal ',route('admin.sucursal.index'),'Sucursales');
            $this->datos['ciudades'] = Ciudad::where('estado',1)->get()->lists('nombre','id');
            return view('cpanel.admin.sucursal.registro',$this->datos);
        }
        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }


    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            $sucursal = new Sucursal($request->all());
            $sucursal->usuario_id = Auth::user()->id;
            $sucursal->save();
            $almacen = [
                'nombre'=>$request->get('xNombre'),
                'direccion'=>$request->get('xDireccion'),
                'sucursal_id'=>$sucursal->id,
                'ciudad_id'=>$sucursal->ciudad->id
            ];
            Almacen::create($almacen);
            return redirect()->route('admin.sucursal.index');
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');

        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
       // dd(User::find($id));
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar Sucursal ',route('admin.sucursal.index'),'Sucursales');
            $this->datos['ciudades'] = Ciudad::where('estado',1)->get()->lists('nombre','id');
            $this->datos['sucursal'] = Sucursal::find($id);






            return view('cpanel.admin.sucursal.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');

        }


    }

    public function update(Request $request, $id)
    {

        if(Auth::user()->can('allow-edit')){
            $sucursal = Sucursal::find($id);
            $sucursal->fill($request->all());
            $sucursal->save();

            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }


    }


    public function destroy($id)
    {

        if(Auth::user()->can('allow-delete')) {
            $sucursal = Sucursal::find($id);
            \Session::flash('user-dead',$sucursal->nombre);
            if(!$sucursal->deleteOk()){
                $sucursal->estado=0;
                $sucursal->save();
                $mensaje = 'La Sucursal Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Sucursal ';
            }
            else{
                Sucursal::destroy($id);
                $mensaje = 'La Sucursal   fue eliminada ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.sucursal.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }


    }
}
