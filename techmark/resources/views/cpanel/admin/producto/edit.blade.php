@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="pull-right">
                    {!! Form::open(['route'=>['admin.producto.destroy',$producto->id],'method'=>'delete','id'=>'form-delete']) !!}
                    <a class="btn btn-danger" id="btn-delete"> <i class="fa fa-trash"></i> Eliminar</a>
                    {!! Form::close() !!}
                </div>
                <h4 class="m-t-0 header-title"><b>Formulario para Actualizacion de Datos</b></h4>
                <p class="text-danger font-13 m-b-30">
                    * Los campos con (*) son obligatorios
                </p>

                @include('cpanel.partials.errors')
                {!! Form::model($producto,['route'=>['admin.producto.update',$producto->id],'method'=>'PUT','files'=>true,'id'=>'form-producto']) !!}
                    @include('cpanel.admin.producto.partials.fields')
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
                    <a class="btn btn-sm btn-inverse" href="{{route('admin.producto.asignacion.talla.create',['id'=>$producto->id,'producto'=>\App\Tool::slug($producto->descripcion,false)])}}" ><i class="fa fa-plus"></i> Asignar Tallas</a>
                </div>
                <h4 class="m-t-0 header-title"><b>TALLAS ASIGNADAS AL PRODUCTO</b></h4>
                <table class="table table-actions-bar">
                    <thead>
                    <tr>
                        <th>TALLA</th>
                        <th>PRECIO 1</th>
                        <th>PRECIO 2</th>
                        <th>PRECIO 3</th>
                        <th COLSPAN="2">ACCIONES</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($producto->tallas as $fila)
                        <tr>
                            <td>{{$fila->talla->nombre}}</td>
                            <td>{{\App\Tool::convertMoney($fila->precio1)}}</td>
                            <td>{{\App\Tool::convertMoney($fila->precio2)}}</td>
                            <td>{{\App\Tool::convertMoney($fila->precio3)}}</td>
                            <td><a href="{{route('admin.producto.asignacion.talla.edit',$fila->id)}}" class="btn btn-inverse btn-sm" ><i class=" ti-angle-double-right"></i> Editar </a></td>
                            <td>
                                {!! Form::open(['route'=>['admin.producto.asignacion.talla.destroy',$fila->id],'method'=>'delete']) !!}
                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Esta Seguro de Eliminar la Talla?')"> <i class="fa fa-trash"></i> Eliminar</button>
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
    @include('cpanel.admin.producto.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.producto.addons.js')
@endsection