<div class="row">
    @if(Request::segment(3)=='create')
    <div class="form-group col-lg-12">
        {!! Form::label('Monto de  Apertura Caja (*)')!!}
        {!! Form::text('apertura',null,['class'=>'form-control autonumber','required'])!!}
    </div>
    @else
        <div class="form-group col-lg-12">
            {!! Form::label('Total Efectivo en el  Sistema (*)')!!}
            {!! Form::text('dat',($caja->totalIG() + $caja->apertura),['class'=>'form-control autonumber','readonly'=>true])!!}
        </div>
        <div class="form-group col-lg-12">
            {!! Form::label('Total Efectivo en Caja Caja (*)')!!}
            {!! Form::text('cierre',null,['class'=>'form-control autonumber','required','id'=>'mcierre'])!!}
        </div>
        <div class="form-group col-lg-12">
            {!! Form::label('Diferencia en Caja')!!}
            {!! Form::text('direferencia',null,['class'=>'form-control ','id'=>'diferencia','disabled'])!!}
        </div>
     @endif
</div>
<div class="row">
    <div class="form-group col-lg-12">
        {!! Form::label('Observaciones')!!}
        {!! Form::textarea('observaciones',null,['class'=>'form-control','rows'=>'5'])!!}
    </div>
</div>
