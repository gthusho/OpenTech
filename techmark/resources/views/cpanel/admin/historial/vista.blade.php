@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        @include('cpanel.partials.errors')
        @include('cpanel.admin.historial.partials.general')
    </div>
@endsection

@section('css')

@endsection
@section('js')

@endsection