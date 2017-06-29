<div class="row">

    <div class="form-group col-lg-5">
        {!! Form::label('Producto Base (*) ')!!}
        {!! Form::select('producto_base_id',$productos,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione un Producto','id'=>'prodbase'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" id="addProducto"><i class="icon-plus"></i> Producto</span>
    </div >
    <div class="form-group col-lg-5">
        {!! Form::label('Talla (*) ')!!}
        {!! Form::select('talla_id',$tallas,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione una Talla','id'=>'talla'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" id="addTalla"><i class="icon-plus"></i> Talla</span>
    </div >
    <div class="form-group col-lg-5">
        {!! Form::label('Material (*)')!!}
        {!! Form::select('material_id',$materiales,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione un Material','id'=>'material'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" id="addMaterial"><i class="icon-plus"></i> Material</span>
    </div >
    <div class="form-group col-lg-3">
        {!! Form::label('Precio (*)')!!}
        {!! Form::text('precio',null,['class'=>'form-control autonumber','required'])!!}
    </div>
    <div class="form-group col-lg-3">
        {!! Form::label('Costo (*)')!!}
        {!! Form::text('costo',null,['class'=>'form-control autonumber','required'])!!}
    </div>

</div>