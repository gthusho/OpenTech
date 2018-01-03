@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

                @include('cpanel.partials.errors')
                {!! Form::model($produccion,['route'=>'admin.clientes.produccion.store','method'=>'post','id'=>'form-produccion']) !!}
                    @include('cpanel.admin.produccion_cli.partials.data')

                {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left">
                {!! Form::open(['route'=>['clientes.confirmProduccion',$produccion->id,'t'],'method'=>'post']) !!}
                <button class="btn btn-primary waves-effect waves-light m-r-5" type="submit" onclick="return confirm('Esta Seguro de Continuar?')">
                    <i class="fa fa-check-square-o"></i>
                    Registrar Producción
                </button>
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
            <div class="pull-right">
                {!! Form::open(['route'=>['admin.clientes.produccion.destroy',$produccion->id],'method'=>'delete']) !!}
                <button  class="btn btn-danger waves-effect waves-light" onclick="return confirm('Esta Seguro de Eliminar la Produccion?')">
                    <i class="ti-close"></i>
                    Eliminar Produccion
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