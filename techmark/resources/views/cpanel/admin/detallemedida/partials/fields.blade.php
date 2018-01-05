<div class="form-group col-lg-6">
    {!! Form::label('Descripcion ')!!}
    {!! Form::textarea('descripcion',null,['class'=>'form-control','rows'=>'4'])!!}
</div>
<div class="row">
    <div class="form-group col-lg-6">
        {!! Form::label('Ubicacion ')!!}
        {!! Form::text('ubicacion',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Largo (*) ')!!}
        {!! Form::text('alto',null,['class'=>'form-control autonumber precio','required'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Ancho (*) ')!!}
        {!! Form::text('ancho',null,['class'=>'form-control autonumber precio','required'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Cantidad (*) ')!!}
        {!! Form::text('cantidad',null,['class'=>'form-control','required','onkeypress'=>'return isNumberKey(event)','id'=>'cant'])!!}
    </div>
</div>
<div class="form-group col-lg-4">
    {!! Form::hidden('visita_cotizacion_id',$visita_cotizacion_id,null,['class'=>'form-control'])!!}
</div>