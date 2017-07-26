@if(Request::segment(4)=='edit')
    <div class="form-group col-lg-12" >
        {!! Form::label('Estado del Producto(*) ')!!}
        {!! Form::select('estado',[1=>'Activa',0=>'Inhabilitado'],null,['class'=>'selectpicker','required'])!!}
    </div>
@endif

<div class="form-group col-lg-12">
    {!! Form::label('Descripcion del Producto (*) ')!!}
    {!! Form::text('descripcion',null,['class'=>'form-control','required'])!!}
</div>
    <div class="form-group col-lg-6">
        {!! Form::label('Codigo Producto (*) ')!!}
        {!! Form::text('codigo',null,['class'=>'form-control','required'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Codigo de Barras ')!!}
        {!! Form::text('codigobarra',null,['class'=>'form-control'])!!}
    </div>
<div class="form-group col-lg-6">
    {!! Form::label('Fecha de importacion del producto ')!!}
    <div class="input-group">
        {!! Form::text('fecha',null,['class'=>'form-control input-datepicker-autoclose','placeholder'=>'yyyy-mm-dd'])!!}
        <span class="input-group-addon bg-custom b-0 text-white">
            <i class="icon-calender"></i>
        </span>
    </div>
</div>

<div class="form-group col-lg-6">
    {!! Form::label('Imagen del Producto ')!!}
    <input type="file" class="filestyle" data-placeholder="sin imagen" name="imagen">
</div>
@if(Request::segment(4)=='edit' && $producto->imagen!='')
    <div class="card-box">
        <h4 class="text-primary header-title m-t-0">Imagen Actual</h4>

        <div class="row">
            <div class="form-group col-lg-12">
                <img src="{{$producto->getImagen()}}" alt="" class="img-thumbnail thumb-lg" >
            </div>
        </div>

    </div>
@endif