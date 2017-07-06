@if(Request::segment(4)=='edit')
    <div class="form-group col-lg-6" >
        {!! Form::label('Estado del Almacen (*) ')!!}
        {!! Form::select('estado',[1=>'Activo',0=>'Inactiva'],null,['class'=>'selectpicker','required'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Sucursal')!!}
        {!! Form::text('sucursal',$almacen->sucursal->nombre,['class'=>'form-control','disabled'])!!}
    </div>
@endif

<div class="form-group col-lg-12">
    {!! Form::label('Nombre Almacen (*) ')!!}
    {!! Form::text('nombre',null,['class'=>'form-control','required'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Direccion (*)')!!}
    {!! Form::text('direccion',null,['class'=>'form-control','required'])!!}
</div>

{{--
<div class="form-group col-lg-6">
    {!! Form::label('Ciudad (*) ')!!}
    {!! Form::select('ciudad_id',$ciudades,null,['class'=>'form-control select2','required','placeholder'=>'Ciudad'])!!}
</div>
--}}