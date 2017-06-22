@if(Request::segment(4)=='edit')
    <div class="form-group col-lg-12" >
        {!! Form::label('Estado de la Cuenta (*) ')!!}
        {!! Form::select('estado',[1=>'Activo',0=>'Inactiva'],null,['class'=>'selectpicker','required'])!!}
    </div>
@endif
<div class="form-group col-lg-12">
    {!! Form::label('Ciudad (*) ')!!}
    {!! Form::text('nombre',null,['class'=>'form-control','required'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Departamento (*)')!!}
    {!! Form::text('departamento',null,['class'=>'form-control','required'])!!}
</div>
