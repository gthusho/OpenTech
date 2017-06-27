<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddMaterialRequest;
use App\Http\Requests\EditMaterialRequest;
use App\Material;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Materiales',route('admin.material.index'),'Almacen');
            $this->datos['materiales'] = Material::material($request->get('s'))
                ->orderBy('estado','desc')
                ->orderBy('nombre','asc')
                ->paginate();
            return view('cpanel.admin.material.list')->with($this->datos);
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
            $this->datos['brand'] = Tool::brand('Agregar Nuevo Material',route('admin.material.index'),'Materiales');
            return view('cpanel.admin.material.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }

    }


    public function store(AddMaterialRequest $request)
    {

        if(Auth::user()->can('allow-insert')){
            if($request->ajax()) {
                $combo = "";
                foreach (Material::where('estado', 1)->get() as $row) {
                    $combo .= "<option value='{$row->id}'>{$row->nombre}</option>";
                }
                $material = new  Material($request->all());
                $material->save();
                $combo .= "<option value='{$material->id}' selected>{$material->nombre}</option>";
                echo $combo;
                exit;
            }else{
                Material::create($request->all());
                return redirect()->route('admin.material.index');
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
            $this->datos['brand'] = Tool::brand('Editar Material',route('admin.material.index'),'Materiales');
            $this->datos['material'] = Material::find($id);
            return view('cpanel.admin.material.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }

    }


    public function update(EditMaterialRequest $request, $id)
    {

        if(Auth::user()->can('allow-edit')){
            $material = Material::find($id);
            $material->fill($request->all());
            $material->save();
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
            $material = Material::find($id);
            \Session::flash('user-dead',$material->nombre);
            if(!$material->deleteOk()){
                $material->estado=0;
                $material->save();
                $mensaje = 'El Material Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Material::destroy($id);
                $mensaje = 'El Material fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.material.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }

    }
}
