<?php

namespace App\Http\Middleware;


use App\Cargo;
use App\Rol;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class isAdmin
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
        if (Auth::user()->rol_id !=1) {
            \Session::flash('message-middleware','Acceso Denegado!! No tienes Privilegios necesarios.');
            Auth::logout();
            return redirect('login');
        }

        return $next($request);
    }
}
