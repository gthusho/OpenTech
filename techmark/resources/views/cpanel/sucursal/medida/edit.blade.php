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
                {!! Form::model($medida,['route'=>['s.medida.update',$medida->id],'method'=>'PUT','files'=>true,'id'=>'form-medida']) !!}
                    @include('cpanel.admin.medida.partials.fields')
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                            Actualizar
                        </button>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="pull-right">
                    <a class="btn btn-sm btn-inverse" href="{{route('s.medida.detalle.create',['id'=>$medida->id])}}" ><i class="fa fa-plus"></i> Tomar Medidas</a>
                </div>
                <h4 class="m-t-0 header-title"><b>MEDIDAS TOMADAS AL CLIENTE</b></h4>
                <table class="table table-actions-bar">
                    <thead>
                    <tr>
                        <th>ESTADO</th>
                        <th>PRODUCTO</th>
                        <th>DESCRIPCION</th>
                        <th>UBICACION</th>
                        <th>CANTIDAD</th>
                        <th>DIMENSIONES</th>
                        <th>PRECIO</th>
                        <th COLSPAN="2">ACCIONES</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($medida->detalle as $fila)
                        <tr>
                            <td><span class="label label-{{$fila->activo()[0]}}">{{$fila->activo()[1]}}</span></td>
                            <td>{{$fila->producto->descripcion}}</td>
                            <td>{{$fila->descripcion}}</td>
                            <td>{{$fila->ubicacion}}</td>
                            <td>{{$fila->cantidad}}</td>
                            <td>{{$fila->alto}}h x {{$fila->largo}}l x {{$fila->ancho}}a</td>
                            <td>{{$fila->precio}}</td>
                            <td><a href="{{route('s.medida.detalle.edit',$fila->id)}}" class="btn btn-inverse btn-sm" ><i class=" ti-angle-double-right"></i> Editar </a></td>
                            <td>
                                {!! Form::open(['route'=>['s.medida.detalle.destroy',$fila->id],'method'=>'delete']) !!}
                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Esta Seguro de Eliminar la Medicion?')"> <i class="fa fa-trash"></i> Eliminar</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('css')
    @include('cpanel.admin.medida.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.medida.addons.js')
@endsection