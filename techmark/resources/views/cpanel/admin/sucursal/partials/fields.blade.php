<div class="row">
    @if(Request::segment(4)=='edit')
        <div class="form-group col-lg-12" >
            {!! Form::label('Estado de la Cuenta (*) ')!!}
            {!! Form::select('estado',['1'=>'Activa','0'=>'Inhabilitado'],null,['class'=>'selectpicker','required'])!!}
        </div>
    @endif

    <div class="form-group col-lg-6">
        {!! Form::label('Nombre Sucursal * ')!!}
        {!! Form::text('nombre',null,['class'=>'form-control','required'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Ciudad  * ')!!}
        {!! Form::select('ciudad_id',$ciudades,null,['class'=>'form-control select2','required','placeholder'=>'Selecciones una Ciudad','id'=>'ciudad'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('NIT (*)')!!}
        {!! Form::text('nit',null,['class'=>'form-control','required'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Dirección (*)')!!}
        {!! Form::text('direccion',null,['class'=>'form-control','required'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Telefono  ')!!}
        {!! Form::text('telefono',null,['class'=>'form-control',''])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Celular ')!!}
        {!! Form::text('celular',null,['class'=>'form-control',''])!!}
    </div>

</div>
<div class="row ">
    @if(Request::segment(4)=='edit')
    <div class="col-lg-12">
        <div class="panel panel-border ">
            <div class="panel-heading">
                <h3 class="panel-title">INFORMACION DEL ALMACEN</h3>
            </div>
            <div class="panel-body" id="depositos">
                <ul class="list-unstyled">
                    <li><span class="text-custom">Nombre Almacen:</span> {{$sucursal->almacen->nombre}}</li>
                    <li><span class="text-custom">Direccion:</span> {{$sucursal->almacen->direccion}}</li>
                    <li class="m-t-15"><a class="btn btn-inverse btn-xs" href="{{route('admin.almacen.edit',$sucursal->almacen->id)}}" target="_blank">Editar Informacion Almacen</a></li>
                </ul>
            </div>
        </div>
    </div>
    @else
        <div class="col-lg-12">
            <div class="panel panel-border ">
                <div class="panel-heading">
                    <h3 class="panel-title">INFORMACION DEL ALMACEN</h3>
                </div>
                <div class="panel-body" id="depositos">
                    <div class="form-group col-lg-6">
                        {!! Form::label('Nombre Almacen  ')!!}
                        {!! Form::text('xNombre',null,['class'=>'form-control','required'])!!}
                    </div>
                    <div class="form-group col-lg-6">
                        {!! Form::label('Dirección Almacen (*)')!!}
                        {!! Form::text('xDireccion',null,['class'=>'form-control','required'])!!}
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
