<?php

namespace App\Http\Middleware;

use App\Modulos;
use App\Permisos;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class Observador
{
    protected $auth;


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    function checkAccess($to){
        $idModulo = Modulos::where('nombre',$to)->get()->first();
        $listAcess = Permisos::where('usuario_id',$this->auth->user()->id)->get()->lists('modulo_id')->Toarray();
        if($idModulo==null || $idModulo=='')
        {
            $idModulo=0;

        }

        if(in_array($idModulo->id, $listAcess))

            return true;
        else
            return false;


    }


    public function handle($request, Closure $next,$access)
    {

        if (!$this->checkAccess($access)) {
            \Session::flash("message","Acceso Denegado");
            return redirect('dashboard');
        }

        return $next($request);
    }
}