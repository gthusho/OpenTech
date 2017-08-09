<?php

namespace App\Http\Middleware;


use App\ATMBranchOffice;
use App\Cargo;
use App\Rol;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class ClosedATM
{
    protected $auth;


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // el primero cargo siempre debe ser administrador
    // id 1 == 'Administrador'
    public function handle($request, Closure $next)
    {
        $atm = new ATMBranchOffice($this->auth->user());
        $atm->check();
        if ($atm->getEstado()!='p') {
            \Session::flash('message','TU CAJA SE ENCUENTRA CERRADA!');
            return redirect('dashboard');

        }

        return $next($request);
    }
}
