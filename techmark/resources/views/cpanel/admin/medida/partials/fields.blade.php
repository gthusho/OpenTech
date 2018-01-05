<div class="row">
    <div class="form-group col-lg-3">
        {!! Form::label('Cliente (*) ')!!}
        {!! Form::select('cliente_id',$clientes,null,['class'=>'form-control select2','placeholder'=>'Seleccione un cliente','required','id'=>'cliente'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" id="addCliente" ><i class="icon-plus"></i> Cliente</span>
    </div >
    <div class="form-group col-lg-4">
        {!! Form::label('Fecha de visita (*) ')!!}
        {!! Form::text('fecha',null,['class'=>'form-control','id'=>"datepicker-autoclose",'required'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Direccion (*) ')!!}
        {!! Form::text('direccion',null,['class'=>'form-control','required'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Observaciones ')!!}
        {!! Form::textarea('observacion',null,['class'=>'form-control','rows'=>'4'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Zona ')!!}
        {!! Form::text('zona',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Barrio ')!!}
        {!! Form::text('barrio',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('X ')!!}
        {!! Form::text('x',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Y ')!!}
        {!! Form::text('y',null,['class'=>'form-control'])!!}
    </div>
</div>