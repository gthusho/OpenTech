
<div class=" m-b-30 pull-right">
    {!! Form::model(Request::all(), ['route' => ['admin.compra.index'],'method'=>'GET','class'=>'form-inline']) !!}
   {{--
    <div class="form-group">
        <label class="sr-only" for="material">Categoria</label>
        {!! Form::select('categoria',$categorias,null,['class'=>'form-control select2','placeholder'=>'Seleccione una categoria'])!!}
    </div>
    <div class="form-group">
        <label class="sr-only" for="marca">Marca</label>
        {!! Form::select('marca',$marcas,null,['class'=>'form-control select2','placeholder'=>'Seleccione una marca'])!!}
    </div>
    <div class="form-group">
        <label class="sr-only" for="material">Material</label>
        {!! Form::select('material',$materiales,null,['class'=>'form-control select2','placeholder'=>'Seleccione un material'])!!}
    </div>
    <div class="form-group">
        <label class="sr-only" for="medida">Medida</label>
        {!! Form::select('medida',$medidas,null,['class'=>'form-control select2','placeholder'=>'Seleccione una medida'])!!}
    </div>

--}}
    <div class="form-group">
        <label class="sr-only" for="type">Buscar por</label>
        {!! Form::select('type',[0=>'Nombre Articulo',1=>'Codigo',2=>'Codigo de Barras'],null,['class'=>'selectpicker','data-style'=>"btn-primary btn-custom"])!!}
    </div>
    <div class="form-group">
        <label for="name"  class="sr-only">Que Buscar</label>
        {!! Form::text('s',null,['placeholder'=>'buscar..','class'=>'form-control']) !!}
    </div>
    <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10 btn-md">Buscar</button>
    {!! Form::close() !!}


</div>
