
<div class=" m-b-30 pull-right">
    {!! Form::model(Request::all(), ['route' => ['admin.venta_art.index'],'method'=>'GET','class'=>'form-inline']) !!}

    <div class="form-group">
        <div class="input-group">
            {!! Form::text('f',null,['class'=>'form-control','','autocomplete'=>"off",'id'=>"datepicker-autoclose",'data-date-format'=>'yyyy/mm/dd'])!!}
            <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
        </div><!-- input-group -->
    </div>
    <div class="form-group">
        <label class="sr-only" for="sucursal">Sucursal</label>
        {!! Form::select('sucursal',$sucursales,null,['class'=>'form-control select2','placeholder'=>'Seleccione una sucursal...'])!!}
    </div>
    <div class="form-group">
        <label class="sr-only" for="type">Buscar por</label>
        {!! Form::select('type',[0=>'Codigo',1=>'Nombre Cliente',2=>'Nit'],null,['class'=>'selectpicker','data-style'=>"btn-primary btn-custom"])!!}
    </div>
    <div class="form-group">
        <label for="name"  class="sr-only">Que Buscar</label>
        {!! Form::text('s',null,['placeholder'=>'buscar..','class'=>'form-control']) !!}
    </div>
    <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10 btn-md">Buscar</button>
    {!! Form::close() !!}


</div>
