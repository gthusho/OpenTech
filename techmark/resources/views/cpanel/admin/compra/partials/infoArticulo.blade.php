<fieldset class="scheduler-border">
    <legend class="scheduler-border">DATOS ARTICULO</legend>

    <div class="form-group col-lg-12">
        {!! Form::text('articulo',null,['class'=>'form-control cleanclean','readonly'=>true,'id'=>'anombre'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Categoria ')!!}
        {!! Form::text('categoria',null,['class'=>'form-control cleanclean','disabled','id'=>'acategoria'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Marca  ')!!}
        {!! Form::text('marca',null,['class'=>'form-control cleanclean','disabled','id'=>'amarca'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('material ')!!}
        {!! Form::text('material',null,['class'=>'form-control cleanclean','disabled','id'=>'amaterial'])!!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('Costo ')!!}
        {!! Form::text('costo',null,['class'=>'form-control cleanclean','disabled','id'=>'acosto'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Precio ')!!}
        {!! Form::text('precio',null,['class'=>'form-control cleanclean','disabled','id'=>'aprecio'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Stock Actual ')!!}
        {!! Form::text('stock',null,['class'=>'form-control cleanclean','disabled','id'=>'astock'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::hidden('articulo_id',null,['class'=>'form-control cleanclean','id'=>'aid'])!!}

    </div>
</fieldset>
