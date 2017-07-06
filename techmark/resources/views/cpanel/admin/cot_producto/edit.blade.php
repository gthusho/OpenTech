@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        {!! Form::model($cotizacion,['route'=>['admin.cot_producto.update',$cotizacion->id],'method'=>'PUT','files'=>true,'id'=>'form-cotizacion-producto']) !!}
        @include('cpanel.admin.cot_producto.partials.data')

        {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left">
                        <span class="btn btn-primary waves-effect waves-light m-r-5" id="btnActualizar">
                            <i class="fa fa-check-square-o"></i>
                            Actualizar Cotizacion
                        </span>
            </div>
            <div class="pull-left">
                        <span class="btn btn-inverse waves-effect waves-light" >
                            <i class=" icon-printer"></i>
                            Imprimir
                        </span>
            </div>
            <div class="pull-right">
                {!! Form::open(['route'=>['admin.cot_producto.destroy',$cotizacion->id],'method'=>'delete']) !!}
                <button  class="btn btn-danger waves-effect waves-light" onclick="return confirm('Esta Seguro de Cancelar la Cotizacion?')">
                    <i class="ti-close"></i>
                    Eliminar Cotizacion
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        {!! Form::open(['route'=>['confirmCotizacionProducto',$cotizacion->id],'method'=>'post','id'=>'confirmar']) !!}
        {!! Form::close() !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">PRODUCTOS AÑADIDOS A LA COTIZACION</h3>
                    </div>
                    <div class="panel-body">
                        @include('cpanel.admin.cot_producto.partials.table')
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