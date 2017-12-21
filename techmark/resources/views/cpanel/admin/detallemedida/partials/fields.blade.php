<div class="row">
    <div class="form-group col-lg-5" >
        {!! Form::label('Producto (*) ')!!}
        {!! Form::select('producto_id',$productos,null,['class'=>'form-control select2','required','id'=>'prodbase'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" id="addProducto"><i class="icon-plus"></i> Producto</span>
    </div >
    <div class="form-group col-lg-6">
        {!! Form::label('Ubicacion ')!!}
        {!! Form::text('ubicacion',null,['class'=>'form-control'])!!}
    </div>
</div>
<div class="form-group col-lg-6">
    {!! Form::label('Descripcion ')!!}
    {!! Form::textarea('descripcion',null,['class'=>'form-control','rows'=>'4'])!!}
</div>
<div class="row">
    <div class="form-group col-lg-2">
        {!! Form::label('Alto (*) ')!!}
        {!! Form::text('alto',null,['class'=>'form-control autonumber precio','required'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Largo (*) ')!!}
        {!! Form::text('largo',null,['class'=>'form-control autonumber precio','required'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Ancho (*) ')!!}
        {!! Form::text('ancho',null,['class'=>'form-control autonumber precio','required'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Cantidad (*) ')!!}
        {!! Form::text('cantidad',null,['class'=>'form-control','required','onkeypress'=>'return isNumberKey(event)','id'=>'cant'])!!}
    </div>
    <div class="form-group col-lg-2">
        {!! Form::label('Precio ')!!}
        {!! Form::text('precio',null,['class'=>'form-control','required','onkeypress'=>'return isNumberKeyDec(event)'])!!}
    </div>
</div>
<div class="form-group col-lg-4">
    {!! Form::hidden('medida_id',$medida_id,null,['class'=>'form-control'])!!}
</div>