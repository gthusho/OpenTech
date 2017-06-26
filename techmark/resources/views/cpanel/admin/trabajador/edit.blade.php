@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <div class="pull-right m-b-10">
                    {!! Form::open(['route'=>['admin.trabajador.destroy',$trabajador->id],'method'=>'delete','id'=>'form-delete']) !!}
                    <a class="btn btn-danger" id="btn-delete"> <i class="fa fa-trash"></i> Eliminar</a>
                    {!! Form::close() !!}
        </div>
    </div>
    <div class="row">

    @include('cpanel.partials.errors')
                {!! Form::model($trabajador,['route'=>['admin.trabajador.update',$trabajador->id],'method'=>'PUT','files'=>true,'id'=>'form-articulo']) !!}
                    @include('cpanel.admin.trabajador.partials.fields')
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                            Actualizar
                        </button>
                    </div>

                {!! Form::close() !!}
            </div>
@endsection

@section('css')
    @include('cpanel.admin.trabajador.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.trabajador.addons.js')
@endsection