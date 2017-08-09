<?php

namespace App\Http\Controllers\Sucursal;

use App\ATMBranchOffice;
use App\Caja;
use App\Sucursal;
use App\Tool;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
    private $datos=null;
    private $permiso = 'caja';
    function __construct()
    {
        $this->middleware('observador:'.$this->permiso);
        $this->middleware('atm', ['except' => ['create','store']]);
        $this->middleware('isCloseatm');

    }

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read'))
        {
            $caja = New ATMBranchOffice(Auth::user());
            if($caja->check()==True && $caja->getEstado()=='p'){
                $this->datos['caja'] = $caja->getAtm();
                return view('cpanel.sucursal.caja.edit',$this->datos);
            }else{
                \Session::flash('message','TU CAJA SE ENCUENTRA CERRADA');
                return redirect('dashboard');
            }
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
        if(Auth::user()->can('allow-insert')){

            return view('cpanel.sucursal.caja.registro');
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            $caja = new ATMBranchOffice(Auth::user());




            $caja->open($request->get('apertura'),$request->get('observaciones'));
            \Session::flash('message','Caja Aperturada Exitosamente!');
            return redirect('dashboard');
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
           $caja = new  ATMBranchOffice(Auth::user());

            $caja->close($request->get('cierre'),$request->get('observaciones'));
            \Session::flash('message','Se Cerro Correctamente Caja!');
            return redirect('dashboard');
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }



}
