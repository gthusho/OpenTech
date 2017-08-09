<?php

namespace App\Http\Controllers\Admin;
use App\Agenda;
use App\Http\Controllers\Controller;
use App\Rol;
use App\Uploader;
use App\User;
use App\Zona;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;
class AgendaController extends Controller
{
    private $datos =  null;
    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Actividades Agendadas',route('admin.agenda.index'),'Agenda ');
            $this->datos['actividades'] =  Agenda::name($request->get('s'))->orderBy('id','desc')->paginate();
            return view('cpanel.admin.agenda.list',$this->datos);
        }
        \Session::flash('message','No tienes Permiso para visualizar informacion..');
        return redirect('dashboard');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Registrar Actividad',route('admin.agenda.index'),'Agenda  ');
            return view('cpanel.admin.agenda.registro',$this->datos);
        }
        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }


    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            $actividad = new Agenda($request->all());
            $actividad->usuario_id = Auth::user()->id;
            if($request->file("archivo")){
                $uploader = new Uploader();
                $data = $uploader->upload($_FILES['archivo'], array(
                    'limit' => 10, //Maximum Limit of files. {null, Number}
                    'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
                    'required' => false, //Minimum one file is required for upload {Boolean}
                    'uploadDir' => \Config::get('upload.archivos'), //Upload directory {String}
                ));

                if($data['isComplete']){
                    $files = $data['data'];
                    $actividad->archivo = $files['metas'][0]['name'];
                    echo json_encode($files['metas'][0]['name']);
                }

                if($data['hasErrors']){
                    $errors = $data['errors'];
                    echo json_encode($errors);
                }
            }


            $actividad->save();
            return redirect()->route('admin.agenda.index');
        }
        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');

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
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar Actividad',route('admin.agenda.index'),'Agenda  ');
            $this->datos['actividad'] = Agenda::find($id);
            return view('cpanel.admin.agenda.edit',$this->datos);
        }
        \Session::flash('message','No tienes Permisos para editar informacion');
        return redirect('dashboard');

    }


    public function update(Request $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $actividad = Agenda::find($id);
            $old = $actividad->archivo;
            $actividad->fill($request->all());

            if($request->file("archivo")){
                if($old!='')
                    \File::Delete(\Config::get('upload.archivos').$old);
                $uploader = new Uploader();
                $data = $uploader->upload($_FILES['archivo'], array(
                    'limit' => 10, //Maximum Limit of files. {null, Number}
                    'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
                    'required' => false, //Minimum one file is required for upload {Boolean}
                    'uploadDir' => \Config::get('upload.archivos'), //Upload directory {String}
                ));

                if($data['isComplete']){
                    $files = $data['data'];
                    $actividad->archivo = $files['metas'][0]['name'];
                    echo json_encode($files['metas'][0]['name']);
                }

                if($data['hasErrors']){
                    $errors = $data['errors'];
                    echo json_encode($errors);
                }
            }


            $actividad->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar informacion ');
        return redirect('dashboard');

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
            $actividad = Agenda::find($id);
            \File::Delete(\Config::get('upload.archivos').$actividad->archivo);
            \Session::flash('actividad-dead',$actividad->asunto);
            Agenda::destroy($id);
            $mensaje = 'La Actividad  fue eliminada ';
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.agenda.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }

    public function archivoAgenda(Request $request,$id)
    {
        $actividad = Agenda::find($id);
        \File::Delete(\Config::get('upload.archivos').$actividad->archivo);
        $actividad->archivo='';
        $actividad->fill($request->all());
        $actividad->save();
        return redirect()->back();
    }
}
