@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <div class="col-lg-12">
                <p class="text-danger font-13 m-b-30">
                    * Los campos con (*) son obligatorios
                </p>

                @include('cpanel.partials.errors')
                {!! Form::model($visita,['route'=>['s.visita.update',$visita->id],'method'=>'PUT','files'=>true,'id'=>'form-visita']) !!}
                    @include('cpanel.admin.medida.partials.fields')

                {!! Form::close() !!}
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="pull-right">
                    <a class="btn btn-sm btn-inverse" href="{{route('s.visita.detalle.create',['id'=>$visita->id])}}" ><i class="fa fa-plus"></i> Tomar Medidas</a>
                </div>
                <h4 class="m-t-0 header-title"><b>MEDIDAS TOMADAS AL CLIENTE</b></h4>
                <table class="table table-actions-bar">
                    <thead>
                    <tr>
                        <th>ESTADO</th>
                        <th>DESCRIPCION</th>
                        <th>UBICACION</th>
                        <th>CANTIDAD</th>
                        <th>DIMENSIONES</th>
                        <th COLSPAN="2">ACCIONES</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($visita->detalle as $fila)
                        <tr>
                            <td><span class="label label-{{$fila->activo()[0]}}">{{$fila->activo()[1]}}</span></td>
                            <td>{{$fila->descripcion}}</td>
                            <td>{{$fila->ubicacion}}</td>
                            <td>{{$fila->cantidad}}</td>
                            <td>{{$fila->alto}} largo x {{$fila->ancho}} ancho</td>
                            <td><a href="{{route('s.visita.detalle.edit',$fila->id)}}" class="btn btn-inverse btn-sm" ><i class=" ti-angle-double-right"></i> Editar </a></td>
                            <td>
                                {!! Form::open(['route'=>['s.visita.detalle.destroy',$fila->id],'method'=>'delete']) !!}
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