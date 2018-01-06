<fieldset class="scheduler-border">
    <legend class="scheduler-border">DATOS ARTICULO</legend>

    <div class="form-group col-lg-4">
        {!! Form::label('Nombre ')!!}
        {!! Form::text('articulo',null,['class'=>'form-control cleanclean','readonly'=>true,'id'=>'anombre'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Stock Actual ')!!}
        {!! Form::text('stock',null,['class'=>'form-control cleanclean','disabled','id'=>'astock'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Categoria ')!!}
        {!! Form::text('categoria',null,['class'=>'form-control cleanclean','disabled','id'=>'acategoria'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Marca  ')!!}
        {!! Form::text('marca',null,['class'=>'form-control cleanclean','disabled','id'=>'amarca'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('material ')!!}
        {!! Form::text('material',null,['class'=>'form-control cleanclean','disabled','id'=>'amaterial'])!!}
    </div>

    <div class="form-group col-lg-3">
        {!! Form::label('Precio 1')!!}
        {!! Form::text('precio1',null,['class'=>'form-control cleanclean','disabled','id'=>'aprecio1'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Precio 2')!!}
        {!! Form::text('precio2',null,['class'=>'form-control cleanclean','disabled','id'=>'aprecio2'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Precio 3')!!}
        {!! Form::text('precio3',null,['class'=>'form-control cleanclean','disabled','id'=>'aprecio3'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Precio 4')!!}
        {!! Form::text('precio4',null,['class'=>'form-control cleanclean','disabled','id'=>'aprecio4'])!!}
    </div>
    <div class="form-group col-lg-3">
        {!! Form::label('Precio 5')!!}
        {!! Form::text('precio5',null,['class'=>'form-control cleanclean','disabled','id'=>'aprecio5'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::hidden('articulo_id',null,['class'=>'form-control cleanclean','id'=>'aid'])!!}

    </div>
</fieldset>
