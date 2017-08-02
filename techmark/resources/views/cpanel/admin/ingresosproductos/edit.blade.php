@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <h5 class="text-danger">* Solo se visualizan productos que tengan asignados tallas y precios</h5>
        <h5 class="text-danger">* Si el producto no se encuentra registrado. Registrar haciendo <a target="_blank" href="{{route('admin.producto.create')}}">click aqui</a></h5>
    </div>
    <div class="row">
        @include('cpanel.partials.errors')
        {!! Form::model($produccion,['route'=>['admin.ingresar.productos.update',$produccion->id],'method'=>'put','id'=>'form-produccion']) !!}
        @include('cpanel.admin.ingresosproductos.partials.data')

        {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left m-r-5">
                <a href="{{route('admin.produccion.index')}}"
                        class="btn btn-primary  waves-effect waves-light">Terminar Edicion
                    <span class="m-l-5"><i class=" icon-check"></i></span></a>
            </div>
            <div class="pull-left">
                <button onclick="printJS('')"
                        class="btn btn-inverse  waves-effect waves-light">Imprimir
                    <span class="m-l-5"><i class=" icon-printer "></i></span></button>
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