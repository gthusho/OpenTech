@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        @include('cpanel.sucursal.venta-credito-art.partials.data')

    </div>
@endsection

@section('css')
    @include('cpanel.admin.venta-credito-art.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.venta-credito-art.addons.js')
@endsection