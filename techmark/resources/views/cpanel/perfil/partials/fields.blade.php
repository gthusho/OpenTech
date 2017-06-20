<div class="form-group col-lg-12">
    {!! Form::label('Nombre Completo* ')!!}
    {!! Form::text('nombre',null,['class'=>'form-control','required'])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Direccion* ')!!}
    {!! Form::text('direccion',null,['class'=>'form-control','required'])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('telefono ')!!}
    {!! Form::text('telefono',null,['class'=>'form-control'])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('celular* ')!!}
    {!! Form::text('celular',null,['class'=>'form-control','required'])!!}
</div>
<div class="form-group col-lg-6">
    {!! Form::label('Contraseña (*)')!!}
    <input type="password" class="form-control  " name="password"  placeholder="Contraseña" >
</div>
<div class="form-group col-lg-6">
    {!! Form::label('Repita Contraseña (*)')!!}
    <input type="password" name="password_confirmation" class="form-control"  placeholder=" repita la Contraseña" >
</div>
