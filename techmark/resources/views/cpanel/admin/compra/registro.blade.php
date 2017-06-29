@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

                @include('cpanel.partials.errors')
                {!! Form::open(['route'=>'admin.compra.store','method'=>'post','files'=>true,'id'=>'form-compra']) !!}
                    @include('cpanel.admin.compra.partials.data')
                    <div class="form-group text-right m-b-0">
                        <span class="btn btn-primary waves-effect waves-light" >
                            <i class="fa fa-check-square-o"></i>
                            Registrar Compra
                        </span>
                        <span  class="btn btn-danger waves-effect waves-light m-l-5">
                            <i class="ti-close"></i>
                            Cancelar Compra
                        </span>
                    </div>
                {!! Form::close() !!}
    </div>
    @include('cpanel.admin.compra.partials.modals')
@endsection

@section('css')
    @include('cpanel.admin.compra.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.compra.addons.js')
@endsection