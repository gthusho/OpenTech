@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        @include('cpanel.admin.compra-credito.partials.data')

    </div>
@endsection

@section('css')
    @include('cpanel.admin.compra-credito.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.compra-credito.addons.js')
@endsection