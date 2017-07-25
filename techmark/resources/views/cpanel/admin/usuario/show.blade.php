@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        @include('cpanel.admin.usuario.partials.data')

    </div>
@endsection

@section('css')
    @include('cpanel.admin.usuario.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.usuario.addons.js')
@endsection