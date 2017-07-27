@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        {!! Form::model($cotizacion,['route'=>'s.cotizacion.store','method'=>'post','files'=>true,'id'=>'form-cotizacion-articulo']) !!}
        @include('cpanel.sucursal.cotizacionarticulo.partials.data')

        {!! Form::close() !!}
        <div class="row m-b-15">
            <div class="form-group text-left col-lg-2">
                        <span class="btn btn-primary waves-effect waves-light" id="btnConfirmar">
                            <i class="fa fa-check-square-o"></i>
                            Registrar Cotizacion
                        </span>
            </div>
            <div class="form-group text-left col-lg-2">
                {!! Form::open(['route'=>['s.cotizacion.destroy',$cotizacion->id],'method'=>'delete']) !!}
                <button  class="btn btn-danger waves-effect waves-light m-l-5" onclick="return confirm('Esta Seguro de Cancelar la Cotizacion?')">
                    <i class="ti-close"></i>
                    Cancelar Cotizacion
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        {!! Form::open(['route'=>['s.confirmCotizacion',$cotizacion->id],'method'=>'post','id'=>'confirmar']) !!}
        {!! Form::close() !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">ARTICULOS AÑADIDOS A LA COTIZACION</h3>
                    </div>
                    <div class="panel-body">
                        @include('cpanel.sucursal.cotizacionarticulo.partials.table')
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('cpanel.admin.cotizacionarticulo.partials.modals')
@endsection

@section('css')
    @include('cpanel.admin.cotizacionarticulo.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.cotizacionarticulo.addons.js')
@endsection