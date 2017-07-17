<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Producto;
use App\ProductoTalla;
use App\Rol;
use App\Talla;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class AsignacionTallaProducto extends Controller
{
    private  $datos = null;
    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Productos con tallas ',route('admin.producto.asignacion.talla.index'),'Tallas & Precios');
            $this->datos['productos'] = ProductoTalla::orderBy('producto_id','desc')->paginate(50);
            return view('cpanel.admin.asiganaciontallas.list')->with($this->datos);
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
    public function create(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            
            $producto = Producto::find($request->get('id'));
            $this->datos['producto'] =  $producto;
            $this->datos['tallas'] = Talla::where('estado',1)->whereNotIn('id',ProductoTalla::where('producto_id',$producto->id)->get()->lists('talla_id')->toArray())->get()->lists('nombre','id');
            $this->datos['brand'] = Tool::brand('Asignar Talla para '.$producto->descripcion ,route('admin.producto.edit',$producto->id),'Retornar al Producto');
            return view('cpanel.admin.asiganaciontallas.registro',$this->datos);
        }
        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }


    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            $producto =  new  ProductoTalla($request->all());
            $producto->save();
            \Session::flash('message','Se Registro Exitosamente la Talla '.$producto->talla->nombre);
            return redirect()->back();
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');

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
       // dd(User::find($id));
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar  tallas ',route('admin.producto.asignacion.talla.index'),'Tallas & Precios');
            $this->datos['pt'] =  ProductoTalla::find($id);
            $producto = $this->datos['pt']->producto;
            $this->datos['producto'] =  $producto;
            $this->datos['tallas'] = Talla::where('estado',1)->whereNotIn('id',ProductoTalla::whereNotIn('talla_id',[$this->datos['pt']->talla_id])->where('producto_id',$producto->id)->get()->lists('talla_id')->toArray())->get()->lists('nombre','id');
            $this->datos['brand'] = Tool::brand('Asignar Talla para '.$producto->descripcion ,route('admin.producto.edit',$producto->id),'Retornar al Producto');
            return view('cpanel.admin.asiganaciontallas.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }


    public function update(Request $request, $id)
    {

        if(Auth::user()->can('allow-edit')){
            $producto = ProductoTalla::find($id);
            $producto->fill($request->all());
            $producto->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return $this->edit($producto->id);
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

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
            ProductoTalla::destroy($id);
            $mensaje = 'Se elimino la talla';
            \Session::flash('message',$mensaje);
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
