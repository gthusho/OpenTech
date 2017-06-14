@if(Request::segment(4)=='edit')
    <div class="form-group col-lg-12" >
        {!! Form::label('Estado de la Cuenta (*) ')!!}
        {!! Form::select('estado',['1'=>'Activa','0'=>'Inhabilitado'],null,['class'=>'selectpicker','required'])!!}
    </div>
@endif

<div class="form-group col-lg-12">
    {!! Form::label('Nombre de Usuario* ')!!}
    {!! Form::text('NombreUsuario',null,['class'=>'form-control','required'])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Nombre Completo * ')!!}
    {!! Form::text('Nombre',null,['class'=>'form-control','required'])!!}
</div>
<div class="form-group col-lg-12" >
    {!! Form::label('Rol (*) ')!!}
    {!! Form::select('IdRol',$roles,null,['class'=>'form-control select2','required'])!!}
</div>
<div class="form-group col-lg-6">
    {!! Form::label('Contraseña (*)')!!}
    <input type="password" class="form-control  " name="password"  placeholder="Contraseña" >
</div>
<div class="form-group col-lg-6">
    {!! Form::label('Repita Contraseña (*)')!!}
    <input type="password" name="password_confirmation" class="form-control"  placeholder=" repita la Contraseña" >
</div>