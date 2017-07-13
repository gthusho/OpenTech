<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('Usuario en caja (*) ')!!}
            {!! Form::select('usuario_id',$usuarios,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione un Usuario'])!!}
        </div >
        <div class="form-group">
            {!! Form::label('Sucursal (*)')!!}
            {!! Form::select('sucursal_id',$sucursales,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione una Sucursal'])!!}
        </div>
        <div class="form-group col-lg-6">
            {!! Form::label('Monto Total: (*)')!!}
            {!! Form::text('monto',null,['class'=>'form-control autonumber','required'])!!}
        </div>
        <div class="form-group col-lg-6">
            {!! Form::label('Fecha: (*)')!!}
            {!! Form::text('fecha',null,['class'=>'form-control','','autocomplete'=>"off",'id'=>"datepicker-autoclose",'data-date-format'=>'yyyy/mm/dd','required'])!!}
        </div>
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Descripcion')!!}
        {!! Form::textarea('descripcion',null,['class'=>'form-control','rows'=>'5'])!!}
    </div>
</div>
