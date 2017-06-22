<?php

namespace App\Http\Controllers\Admin;

use App\CategoriaArticulo;
use App\Http\Requests\AddCategoriaArticuloRequest;
use App\Http\Requests\EditCategoriaArticuloRequest;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoriaArticuloController extends Controller
{
    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Categorias Articulos',route('admin.categoria.index'),'Almacen');
            $this->datos['categorias'] = CategoriaArticulo::categoria($request->get('s'))
                ->orderBy('estado','desc')
                ->orderBy('nombre','asc')
                ->paginate();
            return view('cpanel.admin.categoria.list')->with($this->datos);
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
            $this->datos['brand'] = Tool::brand('Agregar Categorias Articulos',route('admin.categoria.index'),'Categorias Articulos');
            return view('cpanel.admin.categoria.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }

    }


    public function store(AddCategoriaArticuloRequest $request)
    {

        if(Auth::user()->can('allow-insert')){
            CategoriaArticulo::create($request->all());
            return redirect()->route('admin.categoria.index');
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
            $this->datos['brand'] = Tool::brand('Editar Categoria Articulo',route('admin.categoria.index'),'Categorias Articulos');
            $this->datos['categoria'] = CategoriaArticulo::find($id);
            return view('cpanel.admin.categoria.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }

    }


    public function update(EditCategoriaArticuloRequest $request, $id)
    {

        if(Auth::user()->can('allow-edit')){
            $categoria = CategoriaArticulo::find($id);
            $categoria->fill($request->all());
            $categoria->save();
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
            $categoria = CategoriaArticulo::find($id);
            \Session::flash('user-dead',$categoria->nombre);
            if(!$categoria->deleteOk()){
                $categoria->estado=0;
                $categoria->save();
                $mensaje = 'La Categoria Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                CategoriaArticulo::destroy($id);
                $mensaje = 'La Categoria fue eliminada ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.categoria.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }

    }

}
