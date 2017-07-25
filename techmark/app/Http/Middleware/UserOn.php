<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class UserOn
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
    public function handle($request, Closure $next)
    {
        if ($this->auth->user()->estado==0) {
            \Session::flash('message-middleware','Acceso Denegado!! Tu cuenta esta Deshabilitada.');
            $this->auth->logout();
            return redirect('login');
        }

        return $next($request);
    }
}
