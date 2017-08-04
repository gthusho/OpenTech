@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        @include('cpanel.admin.venta_producto_credito.partials.data')

    </div>
@endsection

@section('css')
    @include('cpanel.admin.venta_producto_credito.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.venta_producto_credito.addons.js')
@endsection