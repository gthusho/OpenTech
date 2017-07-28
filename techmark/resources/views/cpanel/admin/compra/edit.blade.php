@extends('theme.ubold.layout_cpanel')
@section('content')

    @include('cpanel.partials.brand')

    <div class="row">

        @include('cpanel.partials.errors')
        {!! Form::model($compra,['route'=>['admin.compra.update',$compra->id],'method'=>'PUT','files'=>true,'id'=>'form-compra']) !!}
        @include('cpanel.admin.compra.partials.data')

        {!! Form::close() !!}
        <div class="pull-left m-b-15">
            <div class="form-group text-left">
                        <span class="btn btn-primary waves-effect waves-light" id="btnActualizar">
                            <i class="fa fa-check-square-o"></i>
                            Actualizar Compra
                        </span>
            </div>

        </div>
        <div class="pull-left m-b-15 m-l-5">
            <div class="form-group text-left">

                <button onclick="printJS('{{url('reportes/compra').'?id='.$compra->id}}')"
                   class="btn btn-inverse  waves-effect waves-light">Imprimir Compra
                    <span class="m-l-5"><i class=" icon-printer"></i></span></button>
            </div>
        </div>


        <div class="pull-right ">
            {!! Form::open(['route'=>['admin.compra.destroy',$compra->id],'method'=>'delete']) !!}
            <button  class="btn btn-danger waves-effect waves-light m-l-5" onclick="return confirm('Esta Seguro de Cancelar la Compra?')">
                <i class="ti-close"></i>
                Eliminar Compra
            </button>
            {!! Form::close() !!}
        </div>
        {!! Form::open(['route'=>['confirmCompra',$compra->id],'method'=>'post','id'=>'confirmar']) !!}
        {!! Form::close() !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">ARTICULOS AÑADIDOS A LA COMPRA</h3>
                    </div>
                    <div class="panel-body">
                        @include('cpanel.admin.compra.partials.table')
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('cpanel.admin.compra.partials.modals')
@endsection

@section('css')
    @include('cpanel.admin.compra.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.compra.addons.js')
@endsection