<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddTallaRequest;
use App\Http\Requests\EditTallaRequest;
use App\Talla;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TallaController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read'))
        {
            $this->datos['brand'] = Tool::brand('Tallas',route('admin.talla.index'),'Productos');
            $this->datos['tallas'] = Talla::talla($request->get('s'))
                ->orderBy('estado','desc')
                ->orderBy('nombre','asc')
                ->paginate();
            return view('cpanel.admin.talla.list')->with($this->datos);
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Agragar Nueva Talla',route('admin.talla.index'),'Tallas');
            return view('cpanel.admin.talla.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }

    public function store(AddTallaRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            if($request->ajax()){
                $combo = "";
                foreach (Talla::where('estado',1)->get() as $row)
                {
                    $combo.="<option value='{$row->id}'>{$row->nombre}</option>";
                }
                $talla = new  Talla($request->all());
                $talla->save();
                $combo.="<option value='{$talla->id}' selected>{$talla->nombre}</option>";
                echo $combo;
                exit;
            }else {
                Talla::create($request->all());
                return redirect()->route('admin.talla.index');
            }
        }else {
            \Session::flash('message', 'No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar Talla',route('admin.talla.index'),'Tallas');
            $this->datos['talla'] = Talla::find($id);
            return view('cpanel.admin.talla.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }

    public function update(EditTallaRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $talla = Talla::find($id);
            $talla->fill($request->all());
            $talla->save();
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
            $talla = Talla::find($id);
            \Session::flash('user-dead',$talla->nombre);
            if(!$talla->deleteOk()){
                $talla->estado=0;
                $talla->save();
                $mensaje = 'La Talla Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito el registro ';
            }
            else{
                Talla::destroy($id);
                $mensaje = 'La Talla fue eliminada ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.talla.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }
    }
}
