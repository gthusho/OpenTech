<div class=" m-b-30 pull-right">
    {!! Form::model(Request::all(), ['route' => ['admin.trabajador.index'],'method'=>'GET','class'=>'form-inline']) !!}
    <div class="form-group">
        <label class="sr-only" for="sucursal">Sucursal</label>
        {!! Form::select('sucursal',$sucursales,null,['class'=>'form-control select2','placeholder'=>'Seleccione una sucursal...'])!!}
    </div>
    <div class="form-group">
        <label for="name"  class="sr-only">Nombre</label>
        {!!  Form::text('s',null,['class'=>"form-control" ,'placeholder'=>"Buscar por nombre"]) !!}
    </div>
    <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10 btn-md">Buscar</button>
    {!! Form::close() !!}
</div>
 