@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        {!! Form::model($venta,['route'=>'s.ventas.productos.store','method'=>'post','files'=>true,'id'=>'form-venta-articulo']) !!}
        @include('cpanel.sucursal.venta_pro.partials.data')

        {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left ">
                <button  class="btn btn-primary waves-effect waves-light" id="showModalVenta">
                    <i class="ti-check"></i>
                     Confirmar Venta
                </button>
            </div>
            <div class="pull-right m-r-15">
                {!! Form::open(['route'=>['s.confirmVentaProducto',$venta->id,'c'],'method'=>'post']) !!}
                <button  class="btn btn-warning waves-effect waves-light" onclick="return confirm('Esta Seguro Anular la venta?')">
                    <i class="ti-close"></i>
                    Anular Venta
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
                        @include('cpanel.sucursal.venta_pro.partials.table')
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('cpanel.sucursal.venta_pro.partials.modals')
@endsection

@section('css')
    @include('cpanel.admin.venta_pro.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.venta_pro.addons.js')
@endsection