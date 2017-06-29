<fieldset class="scheduler-border">
    <legend class="scheduler-border">DATOS COSTOS</legend>
    <div class="form-group">
        {!! Form::label('Cantidad ')!!}
        <input name="xCantidad" type="text" class="form-control autonumber">
    </div>
    <div class="form-group">
        {!! Form::label('Costo (*) ')!!}
        <input name="xCosto" type="text" class="form-control autonumber">
    </div>
    <div class="form-group">
        {!! Form::label('Total ')!!}
        <input type="text" class="form-control autonumber" readonly>
    </div>
</fieldset>
