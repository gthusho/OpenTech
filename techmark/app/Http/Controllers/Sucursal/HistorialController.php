<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 22/06/2017
 * Time: 08:51 AM
 */

namespace App\Http\Controllers\Sucursal;


use App\Clientes;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            if ($request)
            {
                $this->datos['brand'] = Tool::brand('Historial de clientes',route('s.historial.index'),'Historial');
                $this->datos['historial'] = Clientes::id($request->get('cliente'))
                    ->orderBy('razon_social')
                    ->paginate();
                $this->datos['clientes']=Clientes::pluck('razon_social','id');
                return view('cpanel.sucursal.historial.list')->with($this->datos);
            }
            else {
                \Session::flash('message', 'No existen registros de clientes');
            }
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }

    public function edit($id){
        if(Auth::user()->can('allow-read')){
                $this->datos['brand'] = Tool::brand('Historial detallado',route('s.historial.index'),'Historial');
                $this->datos['historial'] = Clientes::find($id);
                return view('cpanel.admin.historial.vista')->with($this->datos);
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }
}