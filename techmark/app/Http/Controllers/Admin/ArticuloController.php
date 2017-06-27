<?php

namespace App\Http\Controllers\Admin;

use App\Articulo;
use App\CategoriaArticulo;
use App\Http\Requests\AddArticuloRequest;
use App\Http\Requests\EditArticuloRequest;
use App\Marca;
use App\Material;
use App\Medida;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticuloController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read'))
        {
            $this->datos['brand'] = Tool::brand('Articulos',route('admin.articulo.index'),'Almacen');
            $this->datos['articulos'] = Articulo::with('categoria','marca','material','medida')
                ->marca($request->get('marca'))
                ->medida($request->get('medida'))
                ->material($request->get('material'))
                ->categoria($request->get('categoria'))
                ->tipo($request->get('type'),$request->get('s'))
                ->orderBy('nombre','asc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.articulo.list')->with($this->datos);
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    function genDatos(){
        $this->datos['categorias']=CategoriaArticulo::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['marcas']=Marca::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['materiales']=Material::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['medidas']=Medida::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
    }
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->genDatos();
            $this->datos['brand'] = Tool::brand('Agragar Nuevo Articulo',route('admin.articulo.index'),'Articulos');
            return view('cpanel.admin.articulo.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }

    public function store(AddArticuloRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            Articulo::create($request->all());
            return redirect()->route('admin.articulo.index');
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if(Auth::user()->can('allow-edit')){
            $this->genDatos();
            $this->datos['brand'] = Tool::brand('Editar Articulo',route('admin.articulo.index'),'Articulos');
            $this->datos['articulo'] = Articulo::find($id);
            return view('cpanel.admin.articulo.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }

    public function update(EditArticuloRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $articulo = Articulo::find($id);
            $articulo->fill($request->all());
            $articulo->save();
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
            $articulo = Articulo::find($id);
            \Session::flash('user-dead',$articulo->nombre);
            if(!$articulo->deleteOk()){
                $articulo->estado=0;
                $articulo->save();
                $mensaje = 'El Articulo Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito el registro ';
            }
            else{
                Articulo::destroy($id);
                $mensaje = 'El Articulo fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.articulo.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }
    }
}
