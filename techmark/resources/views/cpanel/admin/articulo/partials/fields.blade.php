<div class="row">
    @if(Request::segment(4)=='edit')
        <div class="form-group col-lg-6">
            {!! Form::label('Nombre  Articulo (*) ')!!}
            {!! Form::text('nombre',null,['class'=>'form-control','required'])!!}
        </div>
        <div class="form-group col-lg-6" >
            {!! Form::label('Estado  Articulo(*) ')!!}
            {!! Form::select('estado',[1=>'Activa',0=>'Inhabilitado'],null,['class'=>'selectpicker','required'])!!}
        </div>
    @else
        <div class="form-group col-lg-12">
            {!! Form::label('Nombre Articulo (*) ')!!}
            {!! Form::text('nombre',null,['class'=>'form-control','required'])!!}
        </div>
    @endif



    <div class="form-group col-lg-6">
        {!! Form::label('Codigo Articulo (*) ')!!}
        {!! Form::text('codigo',null,['class'=>'form-control','required'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Codigo de Barras ')!!}
        {!! Form::text('codigobarra',null,['class'=>'form-control'])!!}
    </div>
</div>
<div class="row">

    <div class="form-group col-lg-5">
        {!! Form::label('Categoria  Articulo (*) ')!!}
        {!! Form::select('categoria_articulo_id',$categorias,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione una Categoria'])!!}
    </div >
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" ><i class="icon-plus"></i> Categoria</span>
    </div >
    <div class="form-group col-lg-5">
        {!! Form::label('Marca  Articulo (*)')!!}
        {!! Form::select('marca_id',$marcas,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione una Marca'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" ><i class="icon-plus"></i> Marca</span>
    </div >

    <div class="form-group col-lg-5">
        {!! Form::label('Material  Articulo (*)')!!}
        {!! Form::select('material_id',$materiales,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione un Material'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" ><i class="icon-plus"></i> Material</span>
    </div >
    <div class="form-group col-lg-5">
        {!! Form::label('Medida  Articulo (*)')!!}
        {!! Form::select('medida_id',$medidas,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione una Medida'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" ><i class="icon-plus"></i> Medida</span>
    </div >
</div>
<div class="row">
    <div class="form-group col-lg-6">
        {!! Form::label('Costo  Articulo (*)')!!}
        {!! Form::text('costo',null,['class'=>'form-control autonumber','required','data-a-sign'=>"Bs. "])!!}
    </div>

    <div class="form-group col-lg-6">
        {!! Form::label('Stock Minimo Necesario del Articulo (*) ')!!}
        {!! Form::number('stock_min',null,['class'=>'form-control','required'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Precio #1  (*) ')!!}
        {!! Form::text('precio1',null,['class'=>'form-control autonumber','required','data-a-sign'=>"Bs. "])!!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('Precio #2  (*)')!!}
        {!! Form::text('precio2',null,['class'=>'form-control autonumber','required','data-a-sign'=>"Bs. "])!!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('Precio #3  (*)')!!}
        {!! Form::text('precio3',null,['class'=>'form-control autonumber','required','data-a-sign'=>"Bs. "])!!}
    </div>
</div>
