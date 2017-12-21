<?php

namespace App\Http\Controllers\Admin;

use App\Clientes;
use App\Medidas;
use App\Tool;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TomarMedidasController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read'))
        {
            $this->datos['brand'] = Tool::brand('Medidas Tomadas',route('admin.medida.index'),'Medidas');
            $this->datos['medidas'] = Medidas::with('cliente')
                ->cliente($request->get('cliente'))
                ->orderBy('registro','desc')
                ->paginate();
            $this->genDatos();
            return view('cpanel.admin.medida.list')->with($this->datos);
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    function genDatos(){
        $this->datos['clientes']=Clientes::where('estado',true)->pluck('razon_social','id');
    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Agregar Nuevas Medidas',route('admin.medida.index'),'Medidas');
            $this->genDatos();
            return view('cpanel.admin.medida.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            $medida = new Medidas($request->all());
            $medida->save();
            return redirect()->route('admin.medida.index');
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
            $this->datos['brand'] = Tool::brand('Editar Medidas',route('admin.medida.index'),'Medidas');
            $this->datos['medida'] = Medidas::find($id);
            $this->genDatos();
            return view('cpanel.admin.medida.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $medida = Medidas::find($id);
            $medida->fill($request->all());
            $medida->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar informacion ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
        if(Auth::user()->can('allow-delete')) {
            $medida = Medidas::find($id);
            \Session::flash('medida-dead',$medida->cliente->razon_social);
            \DB::table('detalle_medida')->where('medida_id', $medida->id)->delete();
            Medidas::destroy($id);
            $mensaje = 'Las medidas fueron eliminadas ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.medida.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }
    }
}
