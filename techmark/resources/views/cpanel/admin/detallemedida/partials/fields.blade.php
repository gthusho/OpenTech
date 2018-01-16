<div class="row">
    <div class="form-group col-lg-3">
        {!! Form::label('Producto Base (*) ')!!}
        {!! Form::select('producto_base_id',$productos,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione un Producto','id'=>'prodbase'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" id="addProducto"><i class="icon-plus"></i> Producto</span>
    </div >
    <div class="form-group col-lg-3">
        {!! Form::label('Talla (*) ')!!}
        {!! Form::select('talla_id',$tallas,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione una Talla','id'=>'talla'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" id="addTalla"><i class="icon-plus"></i> Talla</span>
    </div >
    <div class="form-group col-lg-3">
        {!! Form::label('Material (*)')!!}
        {!! Form::select('material_id',$materiales,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione un Material','id'=>'material'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" id="addMaterial"><i class="icon-plus"></i> Material</span>
    </div >
</div>
<div class="form-group col-lg-6">
    {!! Form::label('Descripcion ')!!}
    {!! Form::textarea('descripcion',null,['class'=>'form-control','rows'=>'4'])!!}
</div>
<div class="row">
    <div class="form-group col-lg-6">
        {!! Form::label('Ubicacion ')!!}
        {!! Form::text('ubicacion',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Ancho (*) ')!!}
        {!! Form::text('ancho',null,['class'=>'form-control autonumber precio','required','onkeypress'=>'return isNumberKeyDec(event)'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Largo (*) ')!!}
        {!! Form::text('alto',null,['class'=>'form-control autonumber precio','required','onkeypress'=>'return isNumberKeyDec(event)'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Cantidad (*) ')!!}
        {!! Form::text('cantidad',null,['class'=>'form-control','required','onkeypress'=>'return isNumberKey(event)','id'=>'cant'])!!}
    </div>
</div>
<div class="form-group col-lg-4">
    {!! Form::hidden('visita_cotizacion_id',$visita_cotizacion_id,null,['class'=>'form-control'])!!}
</div>