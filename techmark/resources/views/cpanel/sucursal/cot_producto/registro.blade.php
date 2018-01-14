@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

                @include('cpanel.partials.errors')
                {!! Form::model($cotizacion,['route'=>'s.cot_producto.store','method'=>'post','files'=>true,'id'=>'form-cotizacion-producto']) !!}
                    @include('cpanel.sucursal.cot_producto.partials.data')

                {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left">
                        <span class="btn btn-primary waves-effect waves-light m-r-5" id="btnConfirmar">
                            <i class="fa fa-check-square-o"></i>
                            Registrar Cotizacion
                        </span>
            </div>
            <div class="pull-right">
                {!! Form::open(['route'=>['s.cot_producto.destroy',$cotizacion->id],'method'=>'delete']) !!}
                <button  class="btn btn-danger waves-effect waves-light" onclick="return confirm('Esta Seguro de Cancelar la Cotizacion?')">
                    <i class="ti-close"></i>
                    Cancelar Cotizacion
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        {!! Form::open(['route'=>['s.confirmCotizacionProducto',$cotizacion->id],'method'=>'post','id'=>'confirmar']) !!}
        {!! Form::hidden('HCcliente',null,['id'=>'HCcliente']) !!}
        {!! Form::hidden('HCfecha',null,['id'=>'HCfecha']) !!}
        {!! Form::close() !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">PRODUCTOS AÑADIDOS A LA COTIZACION</h3>
                    </div>
                    <div class="panel-body">
                        @include('cpanel.sucursal.cot_producto.partials.table')
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('cpanel.admin.cot_producto.partials.modals')
@endsection

@section('css')
    @include('cpanel.admin.cot_producto.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.cot_producto.addons.js')
@endsection