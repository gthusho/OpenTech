<div class="row">
        <div class="form-group col-lg-6">
            {!! Form::label('Monto Total: (*)')!!}
            {!! Form::text('monto',null,['class'=>'form-control autonumber','required'])!!}
        </div>
        <div class="form-group col-lg-6">
            {!! Form::label('Fecha: (*)')!!}
            {!! Form::text('fecha',null,['class'=>'form-control','','autocomplete'=>"off",'id'=>"datepicker-autoclose",'data-date-format'=>'yyyy/mm/dd','required'])!!}
        </div>
    <div class="form-group col-lg-12">
        {!! Form::label('Descripcion')!!}
        {!! Form::textarea('descripcion',null,['class'=>'form-control','rows'=>'5'])!!}
    </div>
</div>
