@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="pull-right">
                    {!! Form::open(['route'=>['admin.detprodbase.destroy',$detalle->id],'method'=>'delete','id'=>'form-delete']) !!}
                    <a class="btn btn-danger" id="btn-delete"> <i class="fa fa-trash"></i> Eliminar</a>
                    {!! Form::close() !!}
                </div>
                <h4 class="m-t-0 header-title"><b>Formulario para Actualizacion de Datos</b></h4>
                <p class="text-danger font-13 m-b-30">
                    * Los campos con (*) son obligatorios
                </p>

                @include('cpanel.partials.errors')
                {!! Form::model($detalle,['route'=>['admin.detprodbase.update',$detalle->id],'method'=>'PUT','files'=>true,'id'=>'form-detalle-producto-base']) !!}
                    @include('cpanel.admin.detprodbase.partials.fields')
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                            Actualizar
                        </button>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>

@endsection

@section('css')
    @include('cpanel.admin.detprodbase.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.detprodbase.addons.js')
@endsection