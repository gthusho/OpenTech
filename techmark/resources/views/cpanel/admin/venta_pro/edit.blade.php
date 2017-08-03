@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        {!! Form::model($venta,['route'=>['admin.ventas.productos.update',$venta->id],'method'=>'put','id'=>'form-venta-producto']) !!}
        @include('cpanel.admin.venta_pro.partials.data')

        {!! Form::close() !!}
        <div class="row m-b-15 col-lg-12">
            <div class="pull-left m-r-15">
                <button  class="btn btn-primary waves-effect waves-light" id="btnActualizar">
                    <i class="ti-check"></i>
                    Actualizar Venta
                </button>
            </div>
            <div class="pull-left">
                <button onclick="printJS('{{url('reportes/venta/producto').'?id='.$venta->id}}')"
                        class="btn btn-inverse  waves-effect waves-light" >Imprimir
                    <span class="m-l-5"><i class=" icon-printer"></i></span></button>
            </div>

            <div class="pull-right  ">
                {!! Form::open(['route'=>['admin.ventas.productos.destroy',$venta->id],'method'=>'delete']) !!}
                <button  class="btn btn-danger waves-effect waves-light" onclick="return confirm('Esta Seguro de Cancelar la Venta?')">
                    <i class="ti-trash"></i>
                    Eliminar Venta
                </button>
                {!! Form::close() !!}
            </div>


            <div class="pull-right m-r-15">
                {!! Form::open(['route'=>['confirmVentaProducto',$venta->id,'c'],'method'=>'post']) !!}
                <button  class="btn btn-warning waves-effect waves-light" onclick="return confirm('Esta Seguro Anular la venta?')">
                    <i class="ti-close"></i>
                    Anular Venta
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        {!! Form::open(['route'=>['confirmVentaArticulo',$venta->id],'method'=>'post','id'=>'confirmar']) !!}
        {!! Form::close() !!}
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