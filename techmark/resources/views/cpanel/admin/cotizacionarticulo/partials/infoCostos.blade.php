<fieldset class="scheduler-border">
    <legend class="scheduler-border">DATOS PRECIOS</legend>
    <div class="form-group col-lg-3">
        {!! Form::label('Unidad ')!!}
        {!! Form::text('Unidad',null,['class'=>'form-control','disabled','id'=>'amedida'])!!}
    </div>
    <div class="form-group col-lg-3">
        {!! Form::label('Cantidad ')!!}
        <input name="xCantidad" type="text" class="form-control autonumber cleanclean" autocomplete="off" id="xcantidad" required>
    </div>
    <div class="form-group">
        {!! Form::label('Precios (*) ')!!}
    </div>
    <div class="form-group">
        <div class="radio radio-primary radio-inline">
            <input type="radio" value="1" name="xPrecio" required id="P1" class="cRemove ">
            <label for="P1"> P1 </label>
        </div>
        <div class="radio radio-primary radio-inline">
            <input type="radio"  value="2" name="xPrecio" required id="P2" class="cRemove ">
            <label for="P2"> P2 </label>
        </div>
        <div class="radio radio-primary radio-inline">
            <input type="radio"  value="3" name="xPrecio" required id="P3" class="cRemove ">
            <label for="P3"> P3 </label>
        </div>
        <div class="radio radio-primary radio-inline">
            <input type="radio"  value="4" name="xPrecio" required id="P4" class="cRemove ">
            <label for="P4"> P4 </label>
        </div>
        <div class="radio radio-primary radio-inline">
            <input type="radio"  value="3" name="xPrecio" required id="P5" class="cRemove ">
            <label for="P5"> P5 </label>
        </div>
    </div>
</fieldset>