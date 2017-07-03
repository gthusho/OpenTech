@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

                @include('cpanel.partials.errors')
                {!! Form::model($compra,['route'=>'admin.compra.store','method'=>'post','files'=>true,'id'=>'form-compra']) !!}
                    @include('cpanel.admin.compra.partials.data')

                {!! Form::close() !!}
        <div class="row m-b-15">
            <div class="form-group text-left col-lg-2">
                        <span class="btn btn-primary waves-effect waves-light" id="btnConfirmar">
                            <i class="fa fa-check-square-o"></i>
                            Registrar Compra
                        </span>
            </div>
            <div class="form-group text-left col-lg-2">
                {!! Form::open(['route'=>['admin.compra.destroy',$compra->id],'method'=>'delete']) !!}
                <button  class="btn btn-danger waves-effect waves-light m-l-5" onclick="return confirm('Esta Seguro de Cancelar la Compra?')">
                    <i class="ti-close"></i>
                    Cancelar Compra
                </button>
                {!! Form::close() !!}
            </div>
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