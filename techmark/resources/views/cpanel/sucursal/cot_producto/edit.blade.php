@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        {!! Form::model($cotizacion,['route'=>['s.cot_producto.update',$cotizacion->id],'method'=>'PUT','id'=>'form-cotizacion-producto']) !!}
        @include('cpanel.sucursal.cot_producto.partials.data')

        {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left">
                        <span class="btn btn-primary waves-effect waves-light m-r-5" id="btnActualizar">
                            <i class="fa fa-check-square-o"></i>
                            Actualizar Cotizacion
                        </span>
            </div>
            <div class="pull-left">
                <a href="{{url('reportes/cotizacion/producto').'?id='.$cotizacion->id}}"
                   class="btn btn-inverse  waves-effect waves-light" target="_blank" >Imprimir
                    <span class="m-l-5"><i class=" icon-printer"></i></span>
                </a>
            </div>
            <div class="pull-right">
                {!! Form::open(['route'=>['s.cot_producto.destroy',$cotizacion->id],'method'=>'delete']) !!}
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