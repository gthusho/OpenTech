<?php

namespace App\Http\Controllers\Admin;
use App\Almacen;
use App\AlmacenSucursal;
use App\Ciudad;
use App\Http\Controllers\Controller;
use App\Rol;
use App\Sucursal;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class SucursalesController extends Controller
{

    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Listado de Sucursales ',route('admin.sucursal.index'),'Sucursales');
            $this->datos['sucursales'] = Sucursal::name($request->get('s'))
                ->orderBy('id','desc')
                ->paginate();
            return view('cpanel.admin.sucursal.list')->with($this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }

    private $listLibres = null;
    function getAlmacenes(Request $request){
        $ciudad = $request->get('ciudad');
        $sucursal = $request->get('sucursal');
        $this->listLibres = Almacen::where('ciudad_id',$ciudad)->get();

        if(Tool::existe($this->listLibres)){
            $data = null;
            $chek = '';
            foreach ($this->listLibres as $row)
            {

                if($row->id == $sucursal)
                    $chek = 'checked';
                else
                    $chek = '';

                $data.= "
                    <div class='checkbox checkbox-inverse'>
		             <input id='{$row->id}' type='checkbox' name='depositos[]' {$chek} value='{$row->id}'>
		             <label for='{$row->id}'>
		               {$row->nombre}
		             </label>
		         </div>
            ";
            }
            echo $data;
        }

    }
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Agregar Sucursal ',route('admin.sucursal.index'),'Sucursales');
            $this->datos['ciudades'] = Ciudad::where('estado',1)->get()->lists('nombre','id');
            return view('cpanel.admin.sucursal.registro',$this->datos);
        }
        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }


    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            $sucursal = new Sucursal($request->all());
            $sucursal->usuario_id = Auth::user()->id;
            $sucursal->save();
            $this->AgregarDepositos($request->get('depositos'),$sucursal->id);
            return redirect()->route('admin.sucursal.index');
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
        //
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
            $this->datos['brand'] = Tool::brand('Editar Sucursal ',route('admin.sucursal.index'),'Sucursales');
            $this->datos['ciudades'] = Ciudad::where('estado',1)->get()->lists('nombre','id');
            $this->datos['sucursal'] = Sucursal::find($id);






            return view('cpanel.admin.sucursal.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');

        }


    }

    private $relacion = null;
    function AgregarDepositos($repositos,$sucursal){
        if($repositos){
            $json = json_encode($repositos);
            $json = json_decode($json,true);
            foreach ($json as $valu){
                $this->relacion[] = ['almacen_id'=>$valu,'sucursal_id'=>$sucursal];
            }
            if(count($this->relacion)>0)
            {
                \DB::table('almacen_sucursal')->insert($this->relacion);
            }
        }
    }
    public function update(Request $request, $id)
    {
        $relacion=  null;



        if(Auth::user()->can('allow-edit')){
            $sucursal = Sucursal::find($id);
            $sucursal->fill($request->all());
            $sucursal->save();

            AlmacenSucursal::where('sucursal_id',$sucursal->id)->delete();

            $this->AgregarDepositos($request->get('depositos'),$sucursal->id);

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
            $sucursal = Sucursal::find($id);
            \Session::flash('user-dead',$sucursal->nombre);
            if(!$sucursal->deleteOk()){
                $sucursal->estado=0;
                $sucursal->save();
                $mensaje = 'La Sucursal Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Sucursal ';
            }
            else{
                Sucursal::destroy($id);
                $mensaje = 'La Sucursal   fue eliminada ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.sucursal.index');
        }else{
            \Session::flash('message','No tienes Permisos para Borrar informacion');
            return redirect('dashboard');
        }


    }
}
