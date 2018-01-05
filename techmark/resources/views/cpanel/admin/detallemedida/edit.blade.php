@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Formulario para Actualizacion de Datos</b></h4>
                <p class="text-danger font-13 m-b-30">
                    * Los campos con (*) son obligatorios
                </p>

                @include('cpanel.partials.errors')
                {!! Form::model($dm,['route'=>['admin.visita.detalle.update',$dm->id],'method'=>'PUT','files'=>true,'id'=>'form-detalle']) !!}
                    @include('cpanel.admin.detallemedida.partials.fields')
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                            Actualizar
                        </button>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>
@include('cpanel.admin.detallemedida.partials.modal')
@endsection

@section('css')
    @include('cpanel.admin.detallemedida.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.detallemedida.addons.js')
@endsection