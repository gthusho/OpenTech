<?php
$dd = 'disabled';
if(Request::segment(4)=='edit')
    $dd = '';
?>
    <div class="form-group col-lg-12" >
        {!! Form::label('Estado De La Visita (*) ')!!}
        {!! Form::select('estado',Config::get('gthusho.estados_visita'),null,['class'=>'selectpicker','required',$dd])!!}
    </div>

<div class="form-group col-lg-12">
    {!! Form::label('Razón Social / Cliente (*) ')!!}
    {!! Form::select('IdCliente',$clientes,null,['class'=>'form-control select2','required','placeholder'=>'Razón Social o Cliente'])!!}
</div>

<div class="form-group col-lg-6">
    {!! Form::label('Fecha a Visitar * ')!!}

    <div class="input-group">
        {!! Form::text('FechaVisitar',null,['class'=>'form-control','required','autocomplete'=>"off",'id'=>"datepicker-autoclose2",'data-date-format'=>'yyyy/mm/dd'])!!}
        <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
    </div><!-- input-group -->

</div>
<div class="form-group col-lg-6">
    {!! Form::label('Fecha Visitada * ')!!}

    <div class="input-group">
        {!! Form::text('FechaVisitada',null,['class'=>'form-control','required','autocomplete'=>"off",'id'=>"datepicker-autoclose",'data-date-format'=>'yyyy/mm/dd',$dd])!!}
        <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
    </div><!-- input-group -->

</div>
<div class="form-group col-lg-6">
    {!! Form::label('Dirección')!!}
    {!! Form::text('Direccion',null,['class'=>'form-control',''])!!}
</div>
<div class="form-group col-lg-6">
    {!! Form::label('Teléfono')!!}
    {!! Form::text('Telefono',null,['class'=>'form-control'])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Descripcion')!!}
    {!! Form::textarea('descripcion',null,['class'=>'form-control'])!!}
</div>