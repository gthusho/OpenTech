@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

                @include('cpanel.partials.errors')
                {!! Form::model($venta,['route'=>'venta_art.store','method'=>'post','files'=>true,'id'=>'form-venta-articulo']) !!}
                    @include('cpanel.sucursal.venta_art.partials.data')

                {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left">
                        <span class="btn btn-primary waves-effect waves-light m-r-5" id="btnConfirmar">
                            <i class="fa fa-check-square-o"></i>
                            Registrar Venta
                        </span>
            </div>
            <div class="pull-right">
                {!! Form::open(['route'=>['venta_art.destroy',$venta->id],'method'=>'delete']) !!}
                <button  class="btn btn-danger waves-effect waves-light" onclick="return confirm('Esta Seguro de Cancelar la Venta?')">
                    <i class="ti-close"></i>
                    Cancelar Venta
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        {!! Form::open(['route'=>['confirmVentaArticulo',$venta->id],'method'=>'post','id'=>'confirmar']) !!}
        {!! Form::close() !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">ARTICULOS AÑADIDOS A LA VENTA</h3>
                    </div>
                    <div class="panel-body">
                        @include('cpanel.admin.venta_art.partials.table')
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('cpanel.admin.venta_art.partials.modals')
@endsection

@section('css')
    @include('cpanel.admin.venta_art.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.venta_art.addons.js')
@endsection