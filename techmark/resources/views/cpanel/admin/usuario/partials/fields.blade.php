@if(Request::segment(4)=='edit')
    <div class="form-group col-lg-12" >
        {!! Form::label('Estado de la Cuenta (*) ')!!}
        {!! Form::select('estado',['1'=>'Activa','0'=>'Inhabilitado'],null,['class'=>'selectpicker','required'])!!}
    </div>
@endif

<div class="form-group col-lg-12">
    {!! Form::label('Nombre de Usuario* ')!!}
    {!! Form::text('username',null,['class'=>'form-control','required'])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Permitir Ver Informacion * ')!!}
    {!! Form::select('read',[1=>'Si',0=>'No'],null,['class'=>'selectpicker','required','autocomplete'=>"off",'data-style'=>"btn-default btn-custom"])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Permitir Agregar Registros * ')!!}
    {!! Form::select('insert',[0=>'No',1=>'Si'],null,['class'=>'selectpicker','required','autocomplete'=>"off",'data-style'=>"btn-default btn-custom"])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Permitir Editar Informacion * ')!!}
    {!! Form::select('edit',[0=>'No',1=>'Si'],null,['class'=>'selectpicker','required','autocomplete'=>"off",'data-style'=>"btn-default btn-custom"])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Permitir Borrar Registros * ')!!}
    {!! Form::select('delete',[0=>'No',1=>'Si'],null,['class'=>'selectpicker','required','autocomplete'=>"off",'data-style'=>"btn-default btn-custom"])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Nombre Completo * ')!!}
    {!! Form::text('nombre',null,['class'=>'form-control','required'])!!}
</div>
<div class="form-group col-lg-6">
    {!! Form::label('Telefono  ')!!}
    {!! Form::text('telefono',null,['class'=>'form-control',''])!!}
</div>
<div class="form-group col-lg-6">
    {!! Form::label('Celular ')!!}
    {!! Form::text('celular',null,['class'=>'form-control',''])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Dirección (*)')!!}
    {!! Form::text('direccion',null,['class'=>'form-control','required'])!!}
</div>
<div class="form-group col-lg-6" >
    {!! Form::label('Rol (*) ')!!}
    {!! Form::select('rol_id',$roles,null,['class'=>'form-control select2','required','id'=>'cargo'])!!}
</div>
<?php

?>
<div class="form-group col-lg-6" >
    {!! Form::label('Afiliar a: ')!!}
    {!! Form::select('sucursal_id',$sucursales,null,['class'=>'form-control select2','required','disabled','placeholder'=>'Seleccione la Sucursal','id'=>'sucursal'])!!}
</div>
<div class="form-group col-lg-6">
    {!! Form::label('Contraseña (*)')!!}
    <input type="password" class="form-control  " name="password"  placeholder="Contraseña" >
</div>
<div class="form-group col-lg-6">
    {!! Form::label('Repita Contraseña (*)')!!}
    <input type="password" name="password_confirmation" class="form-control"  placeholder=" repita la Contraseña" >
</div>