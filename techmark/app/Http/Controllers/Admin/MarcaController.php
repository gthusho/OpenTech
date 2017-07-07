<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddMarcaRequest;
use App\Http\Requests\EditMarcaRequest;
use App\Marca;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MarcaController extends Controller
{
    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Marcas',route('admin.marca.index'),'Articulos');
            $this->datos['marcas'] = Marca::marca($request->get('s'))
                ->orderBy('estado','desc')
                ->orderBy('nombre','asc')
                ->paginate();
            return view('cpanel.admin.marca.list')->with($this->datos);
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
            $this->datos['brand'] = Tool::brand('Agregar Nueva Marca',route('admin.marca.index'),'Articulos');
            return view('cpanel.admin.marca.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }

    }


    public function store(AddMarcaRequest $request)
    {

        if(Auth::user()->can('allow-insert')){
            if($request->ajax()) {
                $combo = "";
                foreach (Marca::where('estado', 1)->get() as $row) {
                    $combo .= "<option value='{$row->id}'>{$row->nombre}</option>";
                }
                $marca = new  Marca($request->all());
                $marca->save();
                $combo .= "<option value='{$marca->id}' selected>{$marca->nombre}</option>";
                echo $combo;
                exit;
            }else {
                Marca::create($request->all());
                return redirect()->route('admin.marca.index');
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
            $this->datos['brand'] = Tool::brand('Editar Marca',route('admin.marca.index'),'Articulos');
            $this->datos['marca'] = Marca::find($id);
            return view('cpanel.admin.marca.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }

    }


    public function update(EditMarcaRequest $request, $id)
    {

        if(Auth::user()->can('allow-edit')){
            $marca = Marca::find($id);
            $marca->fill($request->all());
            $marca->save();
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
            $marca = Marca::find($id);
            \Session::flash('user-dead',$marca->nombre);
            if(!$marca->deleteOk()){
                $marca->estado=0;
                $marca->save();
                $mensaje = 'La Marca Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Marca::destroy($id);
                $mensaje = 'La Marca fue eliminada ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.marca.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }

    }

}