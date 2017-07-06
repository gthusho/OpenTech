<fieldset class="scheduler-border">
    <legend class="scheduler-border">DATOS PRODUCTO</legend>

    <div class="form-group col-lg-8">
        {!! Form::label('Nombre ')!!}
        {!! Form::text('producto',null,['class'=>'form-control cleanclean','readonly'=>true,'id'=>'pproducto'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Talla ')!!}
        {!! Form::text('talla',null,['class'=>'form-control cleanclean','disabled','id'=>'ptalla'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Material ')!!}
        {!! Form::text('material',null,['class'=>'form-control cleanclean','disabled','id'=>'pmaterial'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Costo  ')!!}
        {!! Form::text('costo',null,['class'=>'form-control cleanclean','disabled','id'=>'pcosto'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Precio ')!!}
        {!! Form::text('precio',null,['class'=>'form-control cleanclean','disabled','id'=>'pprecio'])!!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::hidden('producto_id',null,['class'=>'form-control cleanclean','id'=>'pid'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::hidden('talla_id',null,['class'=>'form-control cleanclean','id'=>'ptallaid'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::hidden('material_id',null,['class'=>'form-control cleanclean','id'=>'pmaterialid'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::hidden('elprecio',null,['class'=>'form-control cleanclean','id'=>'pelprecio'])!!}
    </div>
</fieldset>
