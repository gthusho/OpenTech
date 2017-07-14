@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        {!! Form::model($produccion,['route'=>['admin.produccion.update',$produccion->id],'method'=>'PUT','files'=>true,'id'=>'form-produccion']) !!}
        @include('cpanel.admin.produccion.partials.data')

        {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left">
                        <span class="btn btn-primary waves-effect waves-light m-r-5" id="btnActualizar">
                            <i class="fa fa-check-square-o"></i>
                            Actualizar Produccion
                        </span>
            </div>
            <div class="pull-left">
                    <a href="{{url('reportes/venta').'?id='.$produccion->id}}"
                       class="btn btn-inverse  waves-effect waves-light" target="_blank" >Imprimir
                        <span class="m-l-5"><i class=" icon-printer"></i></span></a>
            </div>

            <div class="pull-right">
                {!! Form::open(['route'=>['admin.produccion.destroy',$produccion->id],'method'=>'delete']) !!}
                <button  class="btn btn-danger waves-effect waves-light" onclick="return confirm('Esta Seguro de Cancelar la Produccion?')">
                    <i class="ti-close"></i>
                    Eliminar Produccion
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
                        <h3 class="panel-title">ARTICULOS AÑADIDOS A LA PRODUCCION</h3>
                    </div>
                    <div class="panel-body">
                        @include('cpanel.admin.produccion.partials.table')
                    </div>
                </div>

            </div>
        </div>
    </div>
@include('cpanel.admin.produccion.partials.modals')
@endsection

@section('css')
    @include('cpanel.admin.produccion.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.produccion.addons.js')
@endsection