@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <div class="pull-right m-b-10">
            {!! Form::open(['route'=>['admin.agenda.destroy',$actividad->id],'method'=>'delete','id'=>'form-delete']) !!}
            <a class="btn btn-danger" id="btn-delete"> <i class="fa fa-trash"></i> Eliminar</a>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        @include('cpanel.partials.errors')
        {!! Form::model($actividad,['route'=>['admin.agenda.update',$actividad->id],'method'=>'PUT','files'=>true, 'id'=>'form-update']) !!}
        <div class="row">
            @include('cpanel.admin.agenda.partials.fields')
            <div class="col-lg-6">
            @include('cpanel.admin.agenda.partials.fieldotros')
                {!! Form::close() !!}
                @if($actividad->archivo!='')
                    @include('cpanel.admin.agenda.partials.fieldfile')
                @endif
            </div>
        </div>
        <div class="form-group text-right m-b-0">
            <button class="btn btn-primary waves-effect waves-light" id="btn-actualizar" >
                Actualizar
            </button>
        </div>
    </div>

@endsection

@section('css')
    @include('cpanel.admin.agenda.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.agenda.addons.js')
@endsection