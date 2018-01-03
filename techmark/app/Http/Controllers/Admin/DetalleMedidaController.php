<?php

namespace App\Http\Controllers\Admin;

use App\DetalleMedida;
use App\Medidas;
use App\Producto;
use App\ProductoBase;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetalleMedidaController extends Controller
{
    private  $datos = null;
    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Detalle de Medidas Tomadas',route('admin.medida.detalle.index'),'Medicion');
            $this->datos['medidas'] = DetalleMedida::orderBy('medida_id','desc')->paginate(50);
            return view('cpanel.admin.detallemedida.list')->with($this->datos);
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

            $medida = Medidas::find($request->get('id'));
            $this->datos['medida_id'] =  $medida->id;
            $this->datos['productos'] = ProductoBase::where('estado',true)->pluck('descripcion','id');
            $this->datos['brand'] = Tool::brand('Toma de medidas para '.$medida->cliente->razon_social ,route('admin.medida.edit',$medida->id),'Retornar al cliente');
            return view('cpanel.admin.detallemedida.registro',$this->datos);
        }
        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }


    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            //dd($request);
            $medida =  new  DetalleMedida($request->all());
            $medida->save();
            \Session::flash('message','Se Registro Exitosamente la toma de medidas ');
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
            $this->datos['brand'] = Tool::brand('Editar  Medidas ',route('admin.medida.detalle.index'),'Toma de Medidas');
            $this->datos['dm'] =  DetalleMedida::find($id);
            $medida = $this->datos['dm']->medida;
            $this->datos['medida_id'] =  $medida->id;
            $this->datos['productos'] = ProductoBase::where('estado',true)->pluck('descripcion','id');
            $this->datos['brand'] = Tool::brand('Medidas para '.$medida->cliente->razon_social ,route('admin.medida.edit',$medida->id),'Retornar al Cliente');
            return view('cpanel.admin.detallemedida.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }


    public function update(Request $request, $id)
    {

        if(Auth::user()->can('allow-edit')){
            $medida = DetalleMedida::find($id);
            $medida->fill($request->all());
            $medida->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return $this->edit($medida->id);
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
            DetalleMedida::destroy($id);
            $mensaje = 'Se elimino la medida';
            \Session::flash('message',$mensaje);
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}