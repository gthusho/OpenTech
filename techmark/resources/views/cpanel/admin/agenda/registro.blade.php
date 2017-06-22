@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">

                @include('cpanel.partials.errors')
                {!! Form::open(['route'=>'admin.agenda.store','method'=>'POST','files'=>true]) !!}
                    @include('cpanel.admin.agenda.partials.fields')
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit" >
                            Registrar
                        </button>
                        <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                            Cancelar
                        </button>
                    </div>

                {!! Form::close() !!}



    </div>

@endsection

@section('css')
    @include('cpanel.admin.agenda.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.agenda.addons.js')
@endsection