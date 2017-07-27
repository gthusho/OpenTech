@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        {!! Form::model($venta,['route'=>['admin.cotizacion.update',$venta->id],'method'=>'PUT','files'=>true,'id'=>'form-cotizacion-articulo']) !!}
        @include('cpanel.admin.cotizacionarticulo.partials.data')

        {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left m-r-5">
                        <span class="btn btn-primary waves-effect waves-light" id="btnActualizar">
                            <i class="fa fa-check-square-o"></i>
                            Actualizar Cotizacion
                        </span>
            </div>
            <div class="pull-left">
                <a href="{{url('reportes/cotizacion/articulo').'?id='.$venta->id}}"
                    class="btn btn-inverse  waves-effect waves-light" target="_blank" >Imprimir
                    <span class="m-l-5"><i class=" icon-printer"></i></span>
                </a>
            </div>

            <div class="pull-right">
                {!! Form::open(['route'=>['admin.cotizacion.destroy',$venta->id],'method'=>'delete']) !!}
                <button  class="btn btn-danger waves-effect waves-light m-l-5" onclick="return confirm('Esta Seguro de Cancelar la Cotizacion?')">
                    <i class="ti-close"></i>
                    Eliminar Cotizacion
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        {!! Form::open(['route'=>['confirmCotizacion',$venta->id],'method'=>'post','id'=>'confirmar']) !!}
        {!! Form::close() !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">ARTICULOS AÑADIDOS A LA COTIZACION</h3>
                    </div>
                    <div class="panel-body">
                        @include('cpanel.admin.cotizacionarticulo.partials.table')
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