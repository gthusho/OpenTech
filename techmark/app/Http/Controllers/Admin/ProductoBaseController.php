<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddProductoBaseRequest;
use App\Http\Requests\EditProductoBaseRequest;
use App\ProductoBase;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductoBaseController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read'))
        {
            $this->datos['brand'] = Tool::brand('Productos Base',route('admin.prodbase.index'),'Productos');
            $this->datos['productos'] = ProductoBase::with('usuario','detprodbase.material')
                ->prodBase($request->get('s'))
                ->orderBy('estado','desc')
                ->orderBy('descripcion','asc')
                ->paginate();
            return view('cpanel.admin.prodbase.list')->with($this->datos);
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Agragar Nuevo Producto Base',route('admin.prodbase.index'),'Productos Base');
            return view('cpanel.admin.prodbase.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }

    public function store(AddProductoBaseRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            if($request->ajax()){
                $combo = "";
                foreach (ProductoBase::where('estado',1)->get() as $row)
                {
                    $combo.="<option value='{$row->id}'>{$row->descripcion}</option>";
                }
                $producto = new  ProductoBase($request->all());
                $producto['usuario_id']=Auth::id();
                $producto->save();
                $combo.="<option value='{$producto->id}' selected>{$producto->descripcion}</option>";
                echo $combo;
                exit;
            }else {
                $request['usuario_id'] = Auth::id();
                ProductoBase::create($request->all());
                return redirect()->route('admin.prodbase.index');
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
            $this->datos['brand'] = Tool::brand('Editar Producto Base',route('admin.prodbase.index'),'Productos Base');
            $this->datos['producto'] = ProductoBase::find($id);
            return view('cpanel.admin.prodbase.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }

    public function update(EditProductoBaseRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $producto = ProductoBase::find($id);
            $producto['usuario_id']=Auth::id();
            $producto->fill($request->all());
            $producto->save();
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
            $producto = ProductoBase::find($id);
            \Session::flash('user-dead',$producto->descripcion);
            if(!$producto->deleteOk()){
                $producto->estado=0;
                $producto->save();
                $mensaje = 'El Producto Base Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito el registro ';
            }
            else{
                ProductoBase::destroy($id);
                $mensaje = 'El Producto Base fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.prodbase.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }
    }
}
