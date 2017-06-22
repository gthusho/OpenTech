@if(Request::segment(4)=='edit')
    <div class="form-group col-lg-12" >
        {!! Form::label('Estado del Articulo(*) ')!!}
        {!! Form::select('estado',[1=>'Activa',0=>'Inhabilitado'],null,['class'=>'selectpicker','required'])!!}
    </div>
@endif

<div class="form-group col-lg-12">
    {!! Form::label('Nombre del Articulo (*) ')!!}
    {!! Form::text('nombre',null,['class'=>'form-control','required'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Codigo del Articulo (*) ')!!}
    {!! Form::text('codigo',null,['class'=>'form-control','required'])!!}
</div>

<div>
	{!! Form::label('Categoria del Articulo (*) ')!!}
	{!! Form::select('categoria_articulo_id',$categorias,null,['class'=>'selectpicker','required'])!!}
</div>

<div>
	{!! Form::label('Marca del Articulo (*)')!!}
	{!! Form::select('marca_id',$marcas,null,['class'=>'selectpicker','required'])!!}
</div>

<div>
	{!! Form::label('Material del Articulo (*)')!!}
	{!! Form::select('material_id',$materiales,null,['class'=>'selectpicker','required'])!!}
</div>

<div>
	{!! Form::label('Medida del Articulo (*)')!!}
	{!! Form::select('medida_id',$medidas,null,['class'=>'selectpicker','required'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Costo del Articulo (*)')!!}
    {!! Form::text('costo',null,['class'=>'form-control','required'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Precio #1 del Articulo (*) ')!!}
    {!! Form::text('precio1',null,['class'=>'form-control','required'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Precio #2 del Articulo ')!!}
    {!! Form::text('precio2',null,['class'=>'form-control'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Precio #3 del Articulo ')!!}
    {!! Form::text('precio3',null,['class'=>'form-control'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Codigo de Barras del Articulo ')!!}
    {!! Form::text('codigobarra',null,['class'=>'form-control'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Stock Minimo Necesario del Articulo (*) ')!!}
    {!! Form::text('stock_min',null,['class'=>'form-control','required'])!!}
</div>