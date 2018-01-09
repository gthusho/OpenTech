@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        {!! Form::model($venta,['route'=>'admin.ventas.productos.store','method'=>'post','files'=>true,'id'=>'form-venta-articulo']) !!}
        @include('cpanel.admin.venta_pro.partials.data')

        {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left ">
                <button  class="btn btn-primary waves-effect waves-light" id="showModalVenta">
                    <i class="ti-check"></i>
                     Confirmar Venta
                </button>
            </div>

            <div class="pull-right ">
                {!! Form::open(['route'=>['admin.ventas.productos.destroy',$venta->id],'method'=>'delete']) !!}
                <button  class="btn btn-danger waves-effect waves-light" onclick="return confirm('Esta Seguro de Cancelar la Venta?')">
                    <i class="ti-trash"></i>
                    Eliminar Venta
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">ARTICULOS AÑADIDOS A LA VENTA</h3>
                    </div>
                    <div class="panel-body">
                        @include('cpanel.admin.venta_pro.partials.table')
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('cpanel.admin.venta_pro.partials.modals')
@endsection

@section('css')
    @include('cpanel.admin.venta_pro.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.venta_pro.addons.js')
@endsection