<div class=" m-b-30 pull-right">
    {!! Form::model(Request::all(), ['route' => ['s.historial.index'],'method'=>'GET','class'=>'form-inline']) !!}
    <div class="form-group">
        <label class="sr-only" for="sucursal">Sucursal</label>
        {!! Form::select('cliente',$clientes,null,['class'=>'form-control select2','placeholder'=>'Seleccione un Cliente...'])!!}
    </div>
    <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10 btn-md">Buscar</button>
    {!! Form::close() !!}
</div>
 