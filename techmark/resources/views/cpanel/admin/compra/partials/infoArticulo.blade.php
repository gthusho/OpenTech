<fieldset class="scheduler-border">
    <legend class="scheduler-border">DATOS ARTICULO</legend>

    <div class="form-group col-lg-12">
        {!! Form::label('Articulo ')!!}
        {!! Form::text('articulo',null,['class'=>'form-control','disabled'])!!}
    </div>
    <div class="form-group col-lg-3">
        {!! Form::label('Categoria ')!!}
        {!! Form::text('categoria',null,['class'=>'form-control','disabled'])!!}
    </div>
    <div class="form-group col-lg-3">
        {!! Form::label('Marca  ')!!}
        {!! Form::text('marca',null,['class'=>'form-control','disabled'])!!}
    </div>
    <div class="form-group col-lg-3">
        {!! Form::label('material ')!!}
        {!! Form::text('material',null,['class'=>'form-control','disabled'])!!}
    </div>
    <div class="form-group col-lg-3">
        {!! Form::label('Unidad ')!!}
        {!! Form::text('Unidad',null,['class'=>'form-control','disabled'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Costo ')!!}
        {!! Form::text('costo',null,['class'=>'form-control','disabled'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Precio ')!!}
        {!! Form::text('precio',null,['class'=>'form-control','disabled'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Stock Actual ')!!}
        {!! Form::text('stock',null,['class'=>'form-control','disabled'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::text('articulo_id',1,['class'=>'form-control'])!!}

    </div>
</fieldset>
