<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Rol;
use App\Sucursal;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Usuarios',route('admin.usuario.index'),'Usuarios & Cargos');
            $this->datos['usuarios'] = User::name($request->get('s'))
                ->orderBy('id','desc')
                ->paginate();
            return view('cpanel.admin.usuario.list')->with($this->datos);
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Editar usuario',route('admin.usuario.index'),'Usuarios');
            $this->datos['roles'] = Rol::where('estado',1)->get()->lists('nombre','id');
            $this->datos['sucursales'] = Sucursal::where('estado',1)->get()->lists('nombre','id');
            return view('cpanel.admin.usuario.registro',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }




    }


    public function store(Request $request)
    {

        if(Auth::user()->can('allow-insert')){
            User::create($request->all());
            return redirect()->route('admin.usuario.index');
        }else{
            \Session::flash('message','No tienes Permisos para agregar registros ');
            return redirect('dashboard');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Permisos',route('admin.usuario.index'),'Usuarios');
            $this->datos['user'] = User::find($id);
            return view('cpanel.admin.usuario.show',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // dd(User::find($id));
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar usuario',route('admin.usuario.index'),'Usuarios');
            $this->datos['user'] = User::find($id);
            $this->datos['roles'] = Rol::where('estado',1)->get()->lists('nombre','id');
            $this->datos['sucursales'] = Sucursal::where('estado',1)->get()->lists('nombre','id');
            return view('cpanel.admin.usuario.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }



    }


    public function update(Requests\EditUserRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $user = User::find($id);
            $user->fill($request->all());
            $user->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(Auth::user()->can('allow-delete')) {
            $user = User::find($id);
            \Session::flash('user-dead',$user->nombre);
            if(!$user->deleteOk()){
                $user->estado=0;
                $user->save();
                $mensaje = 'El usuario  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                User::destroy($id);
                $mensaje = 'El usuario  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.usuario.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }


    }

    function permiso($id,Request $request){


       \DB::table('permisos')->where('usuario_id', $id)->delete();
        $user = User::find($id);
       $data = json_encode($request->get('modulo'));

       $json = json_decode($data,true);
       $modulos = null;


       foreach ($json as $row=>$valor){
           $modulos[]=['modulo_id'=>$valor,'usuario_id'=>$user->id];
       }
        if($modulos!=null)
        \DB::table('permisos')->insert($modulos);

        \Session::flash('message','Se Actualizo Exitosamente la información');
        return redirect()->back();
    }
}
