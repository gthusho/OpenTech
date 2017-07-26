@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

        @include('cpanel.partials.errors')
        {!! Form::open(['route'=>['usuario.permiso',$user->id],'method'=>'POST']) !!}
        @include('cpanel.admin.usuario.partials.data')
        {!! Form::close() !!}
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
                swal("{!! Session::get('message') !!}");
            });

        </script>
    @endif
@endsection