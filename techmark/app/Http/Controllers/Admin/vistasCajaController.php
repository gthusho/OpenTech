<?php

namespace App\Http\Controllers\Admin;

use App\Caja;
use App\Sucursal;
use App\Tool;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class vistasCajaController extends Controller
{
    private $datos=null;

    function genDatos(){
        $this->datos['usuarios']=User::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
        $this->datos['sucursales']=Sucursal::where('estado',true)->orderBy('nombre')->pluck('nombre','id');
    }

    public function edit($id)
    {
        if(Auth::user()->can('allow-edit')){
            $this->genDatos();
            $this->datos['brand'] = Tool::brand('Ver Caja',route('admin.caja.index'),'Cajas');
            $this->datos['caja'] = Caja::find($id);
            $this->datos['atm'] = Caja::find($id);
            return view('cpanel.admin.caja.vista',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }

}
