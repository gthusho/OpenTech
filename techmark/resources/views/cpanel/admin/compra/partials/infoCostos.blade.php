<fieldset class="scheduler-border">
    <legend class="scheduler-border">DATOS COSTOS</legend>
    <div class="form-group">
        {!! Form::label('Unidad ')!!}
        {!! Form::text('Unidad',null,['class'=>'form-control','disabled','id'=>'amedida'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('Cantidad ')!!}
        <input name="xCantidad" type="text" class="form-control autonumber cleanclean" autocomplete="off" id="xcantidad" required>
    </div>
    <div class="form-group">
        {!! Form::label('Costo (*) ')!!}
        <input name="xCosto" type="text" class="form-control autonumber cleanclean" autocomplete="off" id="xcosto" required>

    </div>
</fieldset>
