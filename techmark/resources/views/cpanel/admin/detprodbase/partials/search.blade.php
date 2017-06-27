
<div class=" m-b-30 pull-right">
    {!! Form::model(Request::all(), ['route' => ['admin.detprodbase.index'],'method'=>'GET','class'=>'form-inline']) !!}
    <div class="form-group">
        <label class="sr-only" for="talla">Talla</label>
        {!! Form::select('talla',$tallas,null,['class'=>'form-control select2','placeholder'=>'Seleccione una talla'])!!}
    </div>
    <div class="form-group">
        <label class="sr-only" for="material">Material</label>
        {!! Form::select('material',$materiales,null,['class'=>'form-control select2','placeholder'=>'Seleccione un material'])!!}
    </div>


    <div class="form-group">
        <label for="name"  class="sr-only">Que Buscar</label>
        {!! Form::text('s',null,['placeholder'=>'buscar..','class'=>'form-control']) !!}
    </div>
    <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10 btn-md">Buscar</button>
    {!! Form::close() !!}


</div>
