<div class=" m-b-30 pull-right">
    {!! Form::model(Request::all(), ['route' => ['s.inventario.productos'],'method'=>'GET','class'=>'form-inline']) !!}
    <div class="form-group">
        <label class="sr-only" for="sucursal">Sucursal</label>
        {!! Form::select('sucursal',$sucursales,null,['class'=>'form-control select2','placeholder'=>'Seleccione una sucursal...'])!!}
    </div>
    <div class="form-group">
        <label class="sr-only" for="sucursal">Producto</label>
        {!! Form::select('producto',$productoss,null,['class'=>'form-control select2','placeholder'=>'Seleccione un Productos...'])!!}
    </div>
    <div class="form-group">
        <label class="sr-only" for="sucursal">Talla</label>
        {!! Form::select('talla',$tallas,null,['class'=>'form-control select2','placeholder'=>'Seleccione una Talla...'])!!}
    </div>
    <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10 btn-md">Buscar</button>
    {!! Form::close() !!}

</div>