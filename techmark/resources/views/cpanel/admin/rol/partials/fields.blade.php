@if(Request::segment(4)=='edit')
    <div class="form-group col-lg-12" >
        {!! Form::label('Estado del Rol(*) ')!!}
        {!! Form::select('Activo',[1=>'Activa',0=>'Inhabilitado'],null,['class'=>'selectpicker','required'])!!}
    </div>
@endif

<div class="form-group col-lg-12">
    {!! Form::label('Nombre del Rol* ')!!}
    {!! Form::text('Descripcion',null,['class'=>'form-control','required'])!!}
</div>