<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddMedidaRequest;
use App\Http\Requests\EditMedidaRequest;
use App\Medida;
use App\Tool;
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
            $this->datos['brand'] = Tool::brand('Medidas',route('admin.medida.index'),'Almacen');
            $this->datos['medidas'] = Medida::medida($request->get('s'))
                ->orderBy('estado','desc')
                ->orderBy('nombre','asc')
                ->paginate();
            return view('cpanel.admin.medida.list')->with($this->datos);
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
            $this->datos['brand'] = Tool::brand('Agregar Nueva Medida',route('admin.medida.index'),'Medidas');
            return view('cpanel.admin.medida.registro',$this->datos);
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
                foreach (Medida::where('estado', 1)->get() as $row) {
                    $combo .= "<option value='{$row->id}'>{$row->nombre}</option>";
                }
                $medida = new  Medida($request->all());
                $medida->save();
                $combo .= "<option value='{$medida->id}' selected>{$medida->nombre}</option>";
                echo $combo;
                exit;
            }else {
                Medida::create($request->all());
                return redirect()->route('admin.medida.index');
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
            $this->datos['brand'] = Tool::brand('Editar Medida',route('admin.medida.index'),'Medidas');
            $this->datos['medida'] = Medida::find($id);
            return view('cpanel.admin.medida.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }

    }


    public function update(EditMedidaRequest $request, $id)
    {

        if(Auth::user()->can('allow-edit')){
            $medida = Medida::find($id);
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
            $medida = Medida::find($id);
            \Session::flash('user-dead',$medida->nombre);
            if(!$medida->deleteOk()){
                $medida->estado=0;
                $medida->save();
                $mensaje = 'La Medida Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Medida::destroy($id);
                $mensaje = 'La Medida fue eliminada ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.medida.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }

    }
}
