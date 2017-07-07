<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddProductoRequest;
use App\Http\Requests\EditProductoRequest;
use App\Producto;
use App\Tool;
use App\Uploader;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read'))
        {
            $this->datos['brand'] = Tool::brand('Productos',route('admin.producto.index'),'Productos');
            $this->datos['productos'] = Producto::with('usuario')
                ->producto($request->get('s'))
                ->orderBy('estado','desc')
                ->orderBy('descripcion','asc')
                ->paginate();
            return view('cpanel.admin.producto.list')->with($this->datos);
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Agregar Nuevo Producto',route('admin.producto.index'),'Productos');
            return view('cpanel.admin.producto.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }

    public function store(AddProductoRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            $producto = new Producto($request->all());
            $producto->usuario_id = Auth::user()->id;
            if($request->file("imagen")){
                $uploader = new Uploader();
                $data = $uploader->upload($_FILES['imagen'], array(
                    'limit' => 10, //Maximum Limit of files. {null, Number}
                    'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
                    'required' => false, //Minimum one file is required for upload {Boolean}
                    'uploadDir' => \Config::get('upload.productos'), //Upload directory {String}
                ));

                if($data['isComplete']){
                    $files = $data['data'];
                    $producto->imagen = $files['metas'][0]['name'];
                    echo json_encode($files['metas'][0]['name']);
                }

                if($data['hasErrors']){
                    $errors = $data['errors'];
                    echo json_encode($errors);
                }
            }


            $producto->save();
            return redirect()->route('admin.producto.index');
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
            $this->datos['brand'] = Tool::brand('Editar Producto',route('admin.producto.index'),'Productos');
            $this->datos['producto'] = Producto::find($id);
            return view('cpanel.admin.producto.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }

    public function update(EditProductoRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $producto = Producto::find($id);
            $old = $producto->imagen;
            $producto->fill($request->all());

            if($request->file("imagen")){
                if($old!='')
                    \File::Delete(\Config::get('upload.productos').$old);
                $uploader = new Uploader();
                $data = $uploader->upload($_FILES['imagen'], array(
                    'limit' => 10, //Maximum Limit of files. {null, Number}
                    'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
                    'required' => false, //Minimum one file is required for upload {Boolean}
                    'uploadDir' => \Config::get('upload.productos'), //Upload directory {String}
                ));

                if($data['isComplete']){
                    $files = $data['data'];
                    $producto->imagen = $files['metas'][0]['name'];
                    echo json_encode($files['metas'][0]['name']);
                }

                if($data['hasErrors']){
                    $errors = $data['errors'];
                    echo json_encode($errors);
                }
            }


            $producto->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar informacion ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
        if(Auth::user()->can('allow-delete')) {
            $producto = Producto::find($id);
            \File::Delete(\Config::get('upload.productos').$producto->imagen);
            \Session::flash('user-dead',$producto->descripcion);
            /*if(!$producto->deleteOk()){
                $producto->estado=0;
                $producto->save();
                $mensaje = 'El Producto Base Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito el registro ';
            }
            else{*/
                Producto::destroy($id);
                $mensaje = 'El Producto fue eliminado ';

            //}
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.producto.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }
    }
}
