<fieldset class="scheduler-border">
    <legend class="scheduler-border">DATOS PRECIOS</legend>
    <div class="form-group col-lg-6" >
        {!! Form::label('Cantidad ')!!}
        <input name="xCantidad" type="text" class="form-control cleanclean" autocomplete="off" id="xcantidad" onKeyUp="fncSumar()" required>
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Precio ')!!}
        <input name="xPrecio" type="text" class="form-control autonumber cleanclean" autocomplete="off" id="xprecio" required>
    </div>
    <div class="form-group">
        {!! Form::label('Descripcion ')!!}
        {!! Form::textarea('xDescripcion',null,['class'=>'form-control','rows'=>'3', 'id'=>'xdescripcion'])!!}
    </div>
</fieldset>