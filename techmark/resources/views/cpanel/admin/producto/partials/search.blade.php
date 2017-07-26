<div class=" m-b-30 pull-right">
{!! Form::model(Request::all(), ['route' => ['admin.producto.index'],'method'=>'GET','class'=>'form-inline']) !!}
    <div class="form-group">
        <label for="descripcion"  class="sr-only">Descripcion</label>
        {!! Form::text('s',null,['placeholder'=>'Buscar por Descripcion...','class'=>'form-control']) !!}
    </div>
<div class="form-group">
    <label for="codigo"  class="sr-only">Codigo</label>
    {!! Form::text('c',null,['placeholder'=>'codigo...','class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="barra"  class="sr-only">Codigo de Barra</label>
    {!! Form::text('b',null,['placeholder'=>'codigo de barra...','class'=>'form-control']) !!}
</div>
    <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10 btn-md">Buscar</button>
{!! Form::close() !!}
</div>