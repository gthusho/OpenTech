<?php
/**
 * Created by PhpStorm.
 * User: LisCL
 * Date: 23/06/2017
 * Time: 03:10 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\AddTrabajadorRequest;
use App\Http\Requests\EditTrabajadorRequest;
use App\Sucursal;
use App\Trabajador;
use App\Uploader;
use Illuminate\Http\Request;
use App\Tool;
use Illuminate\Support\Facades\Auth;

class TrabajadorController extends Controller
{
    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            if ($request)
            {
                $this->datos['brand'] = Tool::brand('Trabajador',route('admin.trabajador.index'),'Trabajadores');
                $this->datos['trabajadores'] = Trabajador::name($request->get('s'))
                    ->orderBy('id','desc')
                    ->paginate();
                return view('cpanel.admin.trabajador.list')->with($this->datos);
            }
            else {
                \Session::flash('message', 'No existen registros de ese Trabajador');
            }
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear trabajador',route('admin.trabajador.index'),'Trabajador');
            $this->datos['sucursales'] = Sucursal::where('estado',1)->get()->lists('nombre','id');
            return view('cpanel.admin.trabajador.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }
    public function store(AddTrabajadorRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            $trabajador = new  Trabajador($request->all());
            $trabajador->usuario_id = Auth::user()->id;
            if($request->file("foto")) {
                $uploader = new Uploader();
                $data = $uploader->upload($_FILES['foto'], array(
                    'limit' => 10, //Maximum Limit of files. {null, Number}
                    'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
                    'required' => false, //Minimum one file is required for upload {Boolean}
                    'uploadDir' => \Config::get('upload.trabajadores'), //Upload directory {String}
                ));

                if ($data['isComplete']) {
                    $files = $data['data'];
                    $trabajador->foto = $files['metas'][0]['name'];
                    echo json_encode($files['metas'][0]['name']);
                }

                if ($data['hasErrors']) {
                    $errors = $data['errors'];
                    echo json_encode($errors);
                }
            }
            $trabajador->save();
            return redirect()->route('admin.trabajador.index');
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar Trabajador',route('admin.trabajador.index'),'Trabajadores');
            $this->datos['trabajador'] = Trabajador::find($id);
            $this->datos['sucursales'] = Sucursal::where('estado',1)->get()->lists('nombre','id');
            return view('cpanel.admin.trabajador.edit',$this->datos);
        }else{
            \Session::flash('message','No tienes Permisos para editar ');
            return redirect('dashboard');
        }

    }
    public function update(EditTrabajadorRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $trabajador = Trabajador::find($id);
            $old = $trabajador->foto;
            $trabajador->fill($request->all());

            if($request->file("foto")){
                if($old!='')
                    \File::Delete(\Config::get('upload.trabajadores').$old);
                $uploader = new Uploader();
                $data = $uploader->upload($_FILES['foto'], array(
                    'limit' => 10, //Maximum Limit of files. {null, Number}
                    'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
                    'required' => false, //Minimum one file is required for upload {Boolean}
                    'uploadDir' => \Config::get('upload.trabajadores'), //Upload directory {String}
                ));

                if($data['isComplete']){
                    $files = $data['data'];
                    $trabajador->foto = $files['metas'][0]['name'];
                    echo json_encode($files['metas'][0]['name']);
                }

                if($data['hasErrors']){
                    $errors = $data['errors'];
                    echo json_encode($errors);
                }
            }
            $trabajador->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }
    public function destroy($id)
    {

        if(Auth::user()->can('allow-delete')) {
            $trabajador = Trabajador::find($id);
            \Session::flash('user-dead',$trabajador->ci);
            \File::Delete(\Config::get('upload.trabajadores').$trabajador->foto);
            if(!$trabajador->deleteOk()){
                $mensaje = 'El Almacen  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Almacen::destroy($id);
                $mensaje = 'El Trabajador  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.trabajador.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}