<fieldset class="scheduler-border">
    <legend class="scheduler-border">DATOS PRECIOS</legend>
    <div class="form-group">
        {!! Form::label('Unidad ')!!}
        {!! Form::text('Unidad',null,['class'=>'form-control','disabled','id'=>'amedida'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('Cantidad ')!!}
        <input name="xCantidad" type="text" class="form-control autonumber cleanclean" autocomplete="off" id="xcantidad" required>
    </div>
    <div class="form-group">
        {!! Form::label('Precios (*) ')!!}
    </div>
    <div class="form-group">
        <label class="radio-inline"><input type="radio" name="xPrecio" value="1", required>1</label>
        <label class="radio-inline"><input type="radio" name="xPrecio" value="2", required>2</label>
        <label class="radio-inline"><input type="radio" name="xPrecio" value="3", required>3</label>
    </div>
</fieldset>
