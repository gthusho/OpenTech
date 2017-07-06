@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                {{--
                <div class="pull-right">
                    {!! Form::open(['route'=>['admin.almacen.destroy',$almacen->id],'method'=>'delete','id'=>'form-delete']) !!}
                    <a class="btn btn-danger" id="btn-delete"> <i class="fa fa-trash"></i> Eliminar</a>
                    {!! Form::close() !!}
                </div>
                 --}}
                <h4 class="m-t-0 header-title"><b>Formulario para Actualizacion de Datos</b></h4>
                <p class="text-danger font-13 m-b-30">
                    * Los campos con (*) son obligatorios
                </p>

                @include('cpanel.partials.errors')
                {!! Form::model($almacen,['route'=>['admin.almacen.update',$almacen->id],'method'=>'PUT','files'=>true,'id'=>'form-articulo']) !!}
                    @include('cpanel.admin.almacen.partials.fields')
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
    @include('cpanel.admin.almacen.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.almacen.addons.js')
@endsection