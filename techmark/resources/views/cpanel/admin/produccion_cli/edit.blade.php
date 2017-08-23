@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        {!! Form::model($produccion,['route'=>['admin.clientes.produccion.update',$produccion->id],'method'=>'PUT','files'=>true,'id'=>'form-produccion']) !!}
        @include('cpanel.admin.produccion_cli.partials.data')

        {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left">
                {!! Form::model($produccion,['route'=>['admin.clientes.produccion.update',$produccion->id],'method'=>'PUT','files'=>true,'id'=>'form-produccion']) !!}
                <span class="btn btn-primary waves-effect waves-light m-r-5" id="btnActualizar">
                            <i class="fa fa-check-square-o"></i>
                            Actualizar Producción
                        </span>
                {!! Form::close() !!}
            </div>

            <div class="pull-left">
                {!! Form::open(['route'=>['clientes.confirmProduccion',$produccion->id,'c'],'method'=>'post',]) !!}
                <button class="btn btn-warning waves-effect waves-light m-r-5" type="submit" onclick="return confirm('Esta Seguro de Anular la Produccion?')">
                    <i class="fa fa-check-square-o"></i>
                    Anular Producción
                </button>
                {!! Form::close() !!}

            </div>
            <div class="pull-left">
                <button onclick="printJS('{{url('reportes/clientes/producciones').'?code='.$produccion->id}}')"
                        class="btn btn-inverse  waves-effect waves-light">Imprimir
                    <span class="m-l-5"><i class=" icon-printer"></i></span></button>
            </div>
            <div class="pull-right">
                {!! Form::open(['route'=>['admin.clientes.produccion.destroy',$produccion->id],'method'=>'delete']) !!}
                <button  class="btn btn-danger waves-effect waves-light" onclick="return confirm('Esta Seguro de Cancelar la Produccion?')">
                    <i class="ti-close"></i>
                    Eliminar Producción
                </button>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">ARTICULOS AÑADIDOS A LA PRODUCCION</h3>
                    </div>
                    <div class="panel-body">
                        @include('cpanel.admin.produccion_cli.partials.table')
                    </div>
                </div>

            </div>
        </div>
    </div>
@include('cpanel.admin.produccion_cli.partials.modals')
@endsection

@section('css')
    @include('cpanel.admin.produccion_cli.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.produccion_cli.addons.js')
@endsection