<?php

namespace App\Http\Controllers;

use App\Rol;
use App\Tool;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->datos['brand'] = Tool::brand('Editar Perfil',route('perfil.index'),'Perfil');
        $this->datos['user'] = Auth::user();
        return view('cpanel.perfil.edit',$this->datos);
    }


    public function update(Requests\PerfilRequest $request, $id)
    {

        if(Auth::user()->can('update-perfil',User::find($id))){
            $user = User::find($id);
            $user->nombre = $request->get('nombre');
            $user->celular = $request->get('celular');
            $user->telefono =  $request->get('telefono');
            $user->direccion = $request->get('direccion');
            $user->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','Intentaste Modificar un Perfil que no es tuyo!!');
        return redirect('dashboard');
    }


}
