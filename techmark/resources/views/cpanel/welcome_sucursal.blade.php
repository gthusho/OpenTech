@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        @include('cpanel.admin.caja.partials.general')
    </div>
    <button type="button" onclick="printJS('http://techmark.me/reportes/cotizacion/articulo?id=8')">
        Print PDF
    </button>

@endsection
@section('css')
    @if(Session::has('message'))
        <link href="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css">
    @endif
@endsection
@section('js')
    @if(Session::has('message'))
        <script src="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script>
            $(window).load(function(){
                swal("{{Session::get('message')}}");
            });

        </script>
    @endif


@endsection