<?php

namespace App\Http\Controllers\Admin;

use App\DetalleProductoBase;
use App\Http\Requests\DetalleProductoBaseRequest;
use App\Material;
use App\ProductoBase;
use App\Talla;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetalleProductoBaseController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read'))
        {
            $this->datos['brand'] = Tool::brand('Detalle Productos Base',route('admin.detprodbase.index'),'Productos');
            $this->datos['detalles'] = DetalleProductoBase::with('usuario','prodbase','talla','material')
                ->talla($request->get('talla'))
                ->material($request->get('material'))
                ->detProdBase($request->get('s'))
                ->orderBy('producto_base_id')
                ->orderBy('material_id')
                ->orderBy('talla_id')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.detprodbase.list')->with($this->datos);
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->genDatos();
            $this->datos['brand'] = Tool::brand('Agregar Nuevo Detalle de Producto Base',route('admin.detprodbase.index'),' Detalle Productos Base');
            return view('cpanel.admin.detprodbase.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }

    public function store(DetalleProductoBaseRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            $request['usuario_id']=Auth::id();
            DetalleProductoBase::create($request->all());
            $mensaje = 'El Producto fue agregado ';
            \Session::flash('message',$mensaje);
            return redirect()->back();
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    function genDatos(){
        $this->datos['tallas']=Talla::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['materiales']=Material::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['productos']=ProductoBase::where('estado',true)->orderBy('descripcion','asc')->pluck('descripcion','id');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if(Auth::user()->can('allow-edit')){
            $this->genDatos();
            $this->datos['brand'] = Tool::brand('Editar Producto Base',route('admin.detprodbase.index'),'Productos Base');
            $this->datos['detalle'] = DetalleProductoBase::find($id);
            return view('cpanel.admin.detprodbase.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }

    public function update(DetalleProductoBaseRequest  $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $detalle = DetalleProductoBase::find($id);
            $detalle['usuario_id']=Auth::id();
            $detalle->fill($request->all());
            $detalle->save();
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
            $detalle = DetalleProductoBase::find($id);
            \Session::flash('user-dead',$detalle->prodbase->descripcion);
            DetalleProductoBase::destroy($id);
            $mensaje = 'El Producto Base fue eliminado ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.detprodbase.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }
    }
}
