@extends('theme.ubold.layout_cpanel')
@section('content')

    @if($atm->check()==true && $atm->isClosed()==false)
        <h3>
            <a href="{{route('s.caja.index')}}" class="btn btn-danger"><i class="icon-calculator"></i> <span> Cerrar Caja </span> </a>
        </h3>
    @endif
    <div class="row">
        @if($atm->check()==true && $atm->isClosed()==false)
             @include('cpanel.admin.caja.partials.general')
        @endif
    </div>
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