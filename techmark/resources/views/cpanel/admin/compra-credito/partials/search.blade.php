
<div class=" m-b-30 pull-right">
    {!! Form::model(Request::all(), ['route' => ['admin.compra-credito.index'],'method'=>'GET','class'=>'form-inline']) !!}

    <div class="form-group">
        <div class="input-group">
            {!! Form::text('fecha',null,['class'=>'form-control input-daterange-timepicker','required'])!!}
            <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
        </div>
    </div>
    <div class="form-group">
        <label class="sr-only" for="medida">Sucursal</label>
        {!! Form::select('sucursal',$sucursales,null,['class'=>'form-control select2','placeholder'=>'Seleccione una Sucursal'])!!}
    </div>
    <div class="form-group">
        <label class="sr-only" for="medida">Proveedor</label>
        {!! Form::select('proveedor',$proveedores,null,['class'=>'form-control select2','placeholder'=>'Seleccione un Proveedor'])!!}
    </div>
    <div class="form-group">
        <label for="name"  class="sr-only">Codigo</label>
        {!! Form::text('s',null,['placeholder'=>'codigo de compra','class'=>'form-control']) !!}
    </div>
    <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10 btn-md">Buscar</button>
    {!! Form::close() !!}


</div>
