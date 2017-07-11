<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddMedidaRequest;
use App\Http\Requests\EditMedidaRequest;
use App\Tool;
use App\Unidad;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MedidaController extends Controller
{
    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Unidades Registradas',route('admin.unidad.index'),'Articulos');
            $this->datos['medidas'] = Unidad::medida($request->get('s'))
                ->orderBy('estado','desc')
                ->orderBy('nombre','asc')
                ->paginate();
            return view('cpanel.admin.unidad.list')->with($this->datos);
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Agregar Nueva Unidad',route('admin.unidad.index'),'Articulos');
            return view('cpanel.admin.unidad.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }

    }


    public function store(AddMedidaRequest $request)
    {

        if(Auth::user()->can('allow-insert')){
            if($request->ajax()) {
                $combo = "";
                foreach (Unidad::where('estado', 1)->get() as $row) {
                    $combo .= "<option value='{$row->id}'>{$row->nombre}</option>";
                }
                $medida = new  Unidad($request->all());
                $medida->save();
                $combo .= "<option value='{$medida->id}' selected>{$medida->nombre}</option>";
                echo $combo;
                exit;
            }else {
                Unidad::create($request->all());
                return redirect()->route('admin.unidad.index');
            }
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }

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

        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar Unidad',route('admin.unidad.index'),'Articulos');
            $this->datos['medida'] = Unidad::find($id);
            return view('cpanel.admin.unidad.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }

    }


    public function update(EditMedidaRequest $request, $id)
    {

        if(Auth::user()->can('allow-edit')){
            $medida = Unidad::find($id);
            $medida->fill($request->all());
            $medida->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }

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
            $medida = Unidad::find($id);
            \Session::flash('user-dead',$medida->nombre);
            if(!$medida->deleteOk()){
                $medida->estado=0;
                $medida->save();
                $mensaje = 'La Medida Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Unidad::destroy($id);
                $mensaje = 'La Medida fue eliminada ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.unidad.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }

    }
}
