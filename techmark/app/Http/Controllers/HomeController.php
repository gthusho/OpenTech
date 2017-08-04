<?php

namespace App\Http\Controllers;

use App\ATMBranchOffice;
use App\Caja;
use App\Http\Requests;
use App\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','user_on']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    private $datos = null;
    public function index()
    {
        if(Auth::user()->can('isSucursal',Auth::user()->rol))   {
            $this->datos['brand'] = Tool::brand('Sucursal '.Auth::user()->sucursal->nombre,url(''),'Informacion Rápida');
            $atm = new ATMBranchOffice(Auth::user());
            if($atm->check()){
                $this->datos['caja'] = $atm->getAtm();
            }
            $this->datos['atm'] = $atm;

            return view('cpanel.welcome_sucursal',$this->datos);
        }
        elseif (Auth::user()->can('isAdmin',Auth::user()->rol))   {
            return view('cpanel.welcome');
        }else{
            abort(404);
        }

    }
}
