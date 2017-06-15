<div class="form-group col-lg-12">
    {!! Form::label('Descripcion ')!!}
    {!! Form::text('Descripcion',null,['class'=>'form-control','required','placeholder'=>'Descripcion...'])!!}
</div>


<div class="form-group col-lg-12">
    {!! Form::label('Familia (*) ')!!}
    {!! Form::select('IdFamilia',$familias,null,['class'=>'form-control select2','required','placeholder'=>'Familias'])!!}
</div>

<div>
	{!! Form::label('Medida (*)')!!}
	{!! Form::select('IdMedida',$medidas,null,['class'=>'form-control select2','required','placeholder'=>'Medidas'])!!}
</div>

<div>
	{!! Form::label('Marca (*)')!!}
	{!! Form::select('IdMarca',$marcas,null,['class'=>'form-control select2','required','placeholder'=>'Marca'])!!}
</div>

<div>
	{!! Form::label('Tipo Articulo (*)')!!}
	{!! Form::select('IdTipoArticulo',$tipo_articulo,null,['class'=>'form-control select2','required','placeholder'=>'Tipo Articulo'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Codigo ')!!}
    {!! Form::text('Codigo',null,['class'=>'form-control','required','placeholder'=>'Codigo...'])!!}
</div>