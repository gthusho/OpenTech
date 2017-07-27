@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        {!! Form::model($venta,['route'=>['s.venta_art.update',$venta->id],'method'=>'PUT','files'=>true,'id'=>'form-venta-articulo']) !!}
        @include('cpanel.sucursal.venta_art.partials.data')

        {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left">
                        <span class="btn btn-primary waves-effect waves-light m-r-5" id="btnActualizar">
                            <i class="fa fa-check-square-o"></i>
                            Actualizar Venta
                        </span>
            </div>
            <div class="pull-left">
                    <a href="{{url('reportes/venta').'?id='.$venta->id}}"
                       class="btn btn-inverse  waves-effect waves-light" target="_blank" >Imprimir
                        <span class="m-l-5"><i class=" icon-printer"></i></span></a>
            </div>

            <div class="pull-right">
                {!! Form::open(['route'=>['s.venta_art.destroy',$venta->id],'method'=>'delete']) !!}
                <button  class="btn btn-danger waves-effect waves-light" onclick="return confirm('Esta Seguro de Cancelar la Venta?')">
                    <i class="ti-close"></i>
                    Eliminar Venta
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        {!! Form::open(['route'=>['s.confirmVentaArticulo',$venta->id],'method'=>'post','id'=>'confirmar']) !!}
        {!! Form::close() !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">ARTICULOS AÑADIDOS A LA VENTA</h3>
                    </div>
                    <div class="panel-body">
                        @include('cpanel.sucursal.venta_art.partials.table')
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