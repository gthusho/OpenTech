<div class=" m-b-30 pull-right">
    {!! Form::model(Request::all(), ['route' => ['inventario.articulos'],'method'=>'GET','class'=>'form-inline']) !!}
    <div class="form-group">
        <label class="sr-only" for="sucursal">Sucursal</label>
        {!! Form::select('sucursal',$sucursales,null,['class'=>'form-control select2','placeholder'=>'Seleccione una sucursal...'])!!}
    </div>
    <div class="form-group">
        <label class="sr-only" for="sucursal">Articulo</label>
        {!! Form::select('articulo',$articuloss,null,['class'=>'form-control select2','placeholder'=>'Seleccione un Articulo...'])!!}
    </div>
    <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10 btn-md">Buscar</button>
    {!! Form::close() !!}

</div>