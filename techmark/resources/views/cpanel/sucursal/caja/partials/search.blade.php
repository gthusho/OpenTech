
<div class=" m-b-30 pull-right">
    {!! Form::model(Request::all(), ['route' => ['admin.caja.index'],'method'=>'GET','class'=>'form-inline']) !!}
    <div class="form-group">
        <div class="input-group">
            {!! Form::text('fecha',null,['class'=>'form-control input-daterange-timepicker'])!!}
            <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
        </div>
    </div>

    <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10 btn-md">Buscar</button>
    {!! Form::close() !!}


</div>
