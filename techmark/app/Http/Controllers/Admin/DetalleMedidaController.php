<?php

namespace App\Http\Controllers\Admin;

use App\CotizacionProducto;
use App\DetalleCotizacionProducto;
use App\DetalleMedida;
use App\DetalleProductoBase;
use App\Material;
use App\ProductoBase;
use App\Sucursal;
use App\Talla;
use App\Tool;
use App\VisitaCotizacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetalleMedidaController extends Controller
{
    private  $datos = null;
    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Detalle de Medidas Tomadas',route('admin.medida.detalle.index'),'Medicion');
            $this->datos['medidas'] = DetalleMedida::orderBy('medida_id','desc')->paginate(50);
            return view('cpanel.admin.detallemedida.list')->with($this->datos);
        }else{
            \Session::flash('message','No tienes Permiso para visualizar informacion ');
            return redirect('dashboard');
        }
    }

    public function genDatos(){
        $this->datos['productos'] = ProductoBase::where('estado',true)->pluck('descripcion','id');
        $this->datos['materiales'] = Material::where('estado',true)->pluck('nombre','id');
        $this->datos['tallas']=Talla::where('estado',true)->pluck('nombre','id');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            $visita = VisitaCotizacion::find($request->get('id'));
            $this->datos['visita_cotizacion_id'] =  $visita->id;
            $this->genDatos();
            $this->datos['brand'] = Tool::brand('Toma de medidas para '.$visita->cliente->razon_social ,route('admin.visita.edit',$visita->id),'Retornar al cliente');
            return view('cpanel.admin.detallemedida.registro',$this->datos);
        }
        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }


    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            $medida =  new  DetalleMedida($request->all());
            $medida->usuario_id=Auth::user()->id;
            $medida->save();
            \Session::flash('message','Se Registro Exitosamente la toma de medidas ');
            return redirect()->back();
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
    public function confirmarMedidas(Request $request)
    {
        $detalles = explode(',',$request->get('medidas'));
        $det_medida=DetalleMedida::find($detalles[0]);
        $cotizacion_id=$this->setCotizacion($det_medida->visita->cliente->id);
        for($i=0; $i<count($detalles); $i++){
            $medida=DetalleMedida::find($detalles[$i]);
            $this->existeproducto($medida->producto_base_id,$medida->talla_id,$medida->material_id);
            $medida->estado=1;
            $medida->save();
            $det_cot=new DetalleCotizacionProducto();
            $det_cot->cotizacion_producto_id=$cotizacion_id;
            $det_cot->productos_base_id=$medida->producto_base_id;
            $det_cot->cantidad=$medida->cantidad;
            $det_cot->precio=1;
            $det_cot->usuario_id=Auth::user()->id;
            $det_cot->material_id=$medida->material_id;
            $det_cot->talla_id=$medida->talla_id;
            $det_cot->descripcion=$medida->descripcion."\n".'Medidas: '.$medida->ancho.' ancho x'.$medida->alto.' largo';
            $det_cot->save();
        }
        return redirect()->route('admin.cot_producto.create');
    }

    public function setCotizacion($id){
        $query = CotizacionProducto::where('usuario_id',Auth::user()->id)->where('estado','p')->get();
        if(Tool::existe($query)){
            $cotizacion = $query->first();
            $cotizacion->cliente_id=$id;
            $cotizacion->save();
            \DB::table('detalle_cotizaciones_productos')->where('cotizacion_producto_id',$cotizacion->id)->delete();
            return $cotizacion->id;
        }else{
            $cotizacion = new  CotizacionProducto();
            $cotizacion->usuario_id = Auth::user()->id;
            $cotizacion->estado='p';
            $cotizacion->cliente_id=$id;
            $cotizacion->save();
            return $cotizacion->id;
        }
    }

    public function existeproducto($producto,$talla,$material){
        $detalle=DetalleProductoBase::where('producto_base_id',$producto)->where('material_id',$material)->where('talla_id',$talla)->get();
        if(!Tool::existe($detalle)) {
            $detalle=new DetalleProductoBase();
            $detalle->producto_base_id=$producto;
            $detalle->talla_id=$talla;
            $detalle->material_id=$material;
            $detalle->usuario_id=Auth::user()->id;
            $detalle->costo=0;
            $detalle->precio=0;
            $detalle->save();
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
            $this->datos['brand'] = Tool::brand('Editar  Medidas ',route('admin.visita.detalle.index'),'Toma de Medidas');
            $this->datos['dm'] =  DetalleMedida::find($id);
            $visita = $this->datos['dm']->visita;
            $this->datos['visita_cotizacion_id'] =  $visita->id;
            $this->genDatos();
            $this->datos['brand'] = Tool::brand('Medidas para '.$visita->cliente->razon_social ,route('admin.visita.edit',$visita->id),'Retornar al Cliente');
            return view('cpanel.admin.detallemedida.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }


    public function update(Request $request, $id)
    {

        if(Auth::user()->can('allow-edit')){
            $medida = DetalleMedida::find($id);
            $medida->fill($request->all());
            $medida->usuario_id=Auth::user()->id;
            $medida->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return $this->edit($medida->id);
        }
        \Session::flash('message','No tienes Permisos para editar ');
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
            DetalleMedida::destroy($id);
            $mensaje = 'Se elimino la medida';
            \Session::flash('message',$mensaje);
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
