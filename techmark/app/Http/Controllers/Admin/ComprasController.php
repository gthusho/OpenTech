<?php

namespace App\Http\Controllers\Admin;
use App\Almacen;
use App\Articulo;
use App\Cart;
use App\Compra;
use App\Http\Controllers\Controller;
use App\Proveedor;
use App\Rol;
use App\Sucursal;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ComprasController extends Controller
{

    private  $datos = null;

    public function index(Request $request)
    {

        if(Auth::user()->can('allow-read')){
            $this->datos['brand'] = Tool::brand('Compras Registradas',route('admin.compra.index'),'Compras');
            $this->datos['compras'] = Compra::fecha($request->get('fecha'))
                ->orderBy('id','desc')
                ->paginate();
            return view('cpanel.admin.compra.list',$this->datos);
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }

    function genDataIni(){
        $this->datos['sucursales'] = Sucursal::where('estado',1)->orderBy('nombre')->get()->lists('nombre','id');
        $this->datos['almacenes'] = Almacen::where('estado',1)->orderBy('nombre')->get()->lists('nombre','id');
        $this->datos['proveedores'] = Proveedor::where('estado',1)->orderBy('razon_social')->get()->lists('razon_social','id');
    }
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Registrar una Compra',route('admin.rol.index'),'Compras');
            $this->genDataIni();

                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $this->datos['articulos'] = $cart->items;
                $this->datos['totalPrice'] = $cart->getTotalPrice();
                $this->datos['totalQty'] = $cart->totalQty;
               // var_dump($cart);
            return view('cpanel.admin.compra.registro',$this->datos);
        }


        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');


    }
   function addItemsCompra(Request $request){
        return redirect()->route('admin.compra.create')->with($request);
   }

    public function store(Request $request)
    {
        if(Auth::user()->can('allow-insert')){
            $request->session()->put('cFecha',$request->get('fecha'));
            $request->session()->put('cProveedor',$request->get('proveedor'));
            $request->session()->put('cAlmacen',$request->get('almacen_id'));
            $request->session()->put('cSucursal',$request->get('sucursal_id'));
            $request->session()->put('cFactura',$request->get('nfactura'));

            if($request->get('articulo_id')!=''){
                $item = Articulo::find($request->get('articulo_id'));
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $cantidad = $request->get('xCantidad') ? $request->get('xCantidad') : 0;
                $costo = $request->get('xCosto') ? $request->get('xCosto') : 0;
                $cart->add($item,$item->id,$cantidad,$costo);
                $request->session()->put('cart',$cart);

            }



            return redirect()->route('admin.compra.create');
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
       // dd(User::find($id));
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar Rol',route('admin.rol.index'),'Usuarios & Roles');
            $this->datos['rol'] = Rol::find($id);
            return view('cpanel.admin.rol.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }


    public function update(Requests\EditRolRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $rol = Rol::find($id);
            $rol->fill($request->all());
            $rol->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
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
            $rol = Rol::find($id);
            \Session::flash('user-dead',$rol->nombre);
            if(!$rol->deleteOk()){
                $rol->estado=0;
                $rol->save();
                $mensaje = 'El Rol  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito  ';
            }
            else{
                Rol::destroy($id);
                $mensaje = 'El Rol  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('admin.rol.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
