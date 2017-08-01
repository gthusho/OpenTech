@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <h5 class="text-danger">* Solo se visualizan productos que tengan asignados tallas y precios</h5>
        <h5 class="text-danger">* Si el producto no se encuentra registrado. Registrar haciendo <a target="_blank" href="{{route('admin.producto.create')}}">click aqui</a></h5>
    </div>
    <div class="row">

                @include('cpanel.partials.errors')
                {!! Form::model($produccion,['route'=>'admin.ingresar.productos.store','method'=>'post','files'=>true,'id'=>'form-produccion']) !!}
                    @include('cpanel.admin.ingresosproductos.partials.data')

                {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">

            <div class="pull-left">
                {!! Form::open(['route'=>['produccion.workProduccion',$produccion->id,'t'],'method'=>'post']) !!}
                <button  class="btn btn-primary waves-effect waves-light" onclick="return confirm('Esta apunto de ingresar Productos a inventario, desea continuar?')">
                    <i class="fa fa-check-square-o"></i>
                    Añadir a Inventario
                </button>
                {!! Form::close() !!}
            </div>
            <div class="pull-right">
                {!! Form::open(['route'=>['produccion.workProduccion',$produccion->id,'c'],'method'=>'post']) !!}
                <button  class="btn btn-warning waves-effect waves-light" onclick="return confirm('Esta Seguro de Cancelar la Produccion?')">
                    <i class="ti-close "></i>
                    Cancelar Producción
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        {!! Form::open(['route'=>['confirmProduccion',$produccion->id],'method'=>'post','id'=>'confirmar']) !!}
        {!! Form::close() !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">PRODUCTOS TERMINADOS</h3>
                    </div>
                    <div class="panel-body">
                        @include('cpanel.admin.ingresosproductos.partials.table')
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('cpanel.admin.ingresosproductos.partials.modals')
@endsection

@section('css')
    @include('cpanel.admin.ingresosproductos.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.ingresosproductos.addons.js')
@endsection