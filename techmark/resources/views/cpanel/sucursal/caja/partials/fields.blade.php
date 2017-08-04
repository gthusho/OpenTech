<div class="row">
    @if(Request::segment(3)=='create')
    <div class="form-group col-lg-12">
        {!! Form::label('Total Apertura: (*)')!!}
        {!! Form::text('apertura',null,['class'=>'form-control autonumber','required'])!!}
    </div>
     @endif
</div>
<div class="row">
    <div class="form-group col-lg-12">
        {!! Form::label('Observaciones')!!}
        {!! Form::textarea('observaciones',null,['class'=>'form-control','rows'=>'5'])!!}
    </div>
</div>
