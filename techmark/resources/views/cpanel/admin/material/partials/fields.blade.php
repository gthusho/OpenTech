@if(Request::segment(4)=='edit')
    <div class="form-group col-lg-12" >
        {!! Form::label('Estado del Material(*) ')!!}
        {!! Form::select('estado',[1=>'Activa',0=>'Inhabilitado'],null,['class'=>'selectpicker','required'])!!}
    </div>
@endif

<div class="form-group col-lg-12">
    {!! Form::label('Nombre del Material* ')!!}
    {!! Form::text('nombre',null,['class'=>'form-control','required'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Descripcion del Material ')!!}
    {!! Form::text('descripcion',null,['class'=>'form-control'])!!}
</div>
