<?php

namespace App\Http\Controllers\Admin;

use App\Caja;
use App\Sucursal;
use App\Tool;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read'))
        {
            $this->datos['brand'] = Tool::brand('Cajas',route('admin.caja.index'),'Caja');
            $this->datos['cajas'] = Caja::with('sucursal','usuario')
                ->fecha($request->get('fecha'))
                ->usuario($request->get('usuario'))
                ->sucursal($request->get('sucursal'))
                ->orderBy('id','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.caja.list')->with($this->datos);
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    function genDatos(){
        $this->datos['usuarios']=User::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
    }
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->genDatos();
            $this->datos['brand'] = Tool::brand('Abrir Nueva Caja',route('admin.caja.index'),'Cajas');
            return view('cpanel.admin.caja.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            $caja=new Caja();
            $caja->fill($request->all());
            $existe=Caja::where('usuario_id',$caja->usuario_id)->where('sucursal_id',$caja->sucursal_id)->where('estado','p')->get()->first();
            if(Tool::existe($existe)){
                $existe->apertura=$caja->apertura;
                $existe->cierre=$caja->cierre;
                $existe->observaciones=$caja->observaciones;
                $existe->save();
            }
            else {
                Caja::create($request->all());
            }
            return redirect()->route('admin.caja.index');
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function show($id)
    {
        if(Auth::user()->can('allow-edit')) {
            $caja = Caja::find($id);
            \Session::flash('caja-dead',$caja->id);
            $caja->estado='t';
            $tiempo=Carbon::now('America/La_Paz');
            $caja->fcierre=$tiempo;
            $caja->save();
            $mensaje = 'La cuenta de caja fue cerrada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.caja.index');
        }else{
            \Session::flash('message','No tienes Permisos para cerrar cajas');
            return redirect('dashboard');
        }
    }

    public function edit($id)
    {
        if(Auth::user()->can('allow-edit')){
            $this->genDatos();
            $this->datos['brand'] = Tool::brand('Editar Caja',route('admin.caja.index'),'Cajas');
            $this->datos['caja'] = Caja::find($id);
            return view('cpanel.admin.caja.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }
    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $caja = Caja::find($id);
            $caja->fill($request->all());
            $caja->save();
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
            $caja = Caja::find($id);
            \Session::flash('caja-dead',$caja->id);
            Caja::destroy($id);
            $mensaje = 'La cuenta de caja fue eliminada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.caja.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }
    }
}
