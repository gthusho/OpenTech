@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        @include('cpanel.admin.caja.partials.general')

    </div>
@endsection

@section('css')
    @include('cpanel.admin.caja.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.caja.addons.js')
@endsection