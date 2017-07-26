<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">PRODUCCION {{$produccion->getCode()}}</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">SUCURSAL</legend>
                    {!! Form::text('sucursal',$produccion->sucursal->nombre,['class'=>'form-control','disabled'])!!}
                </fieldset>
            </div>
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">ENCARGADO</legend>
                    {!! Form::text('trabajador',$produccion->trabajador->nombre,['class'=>'form-control','disabled'])!!}
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">DESTINADO PRODUCCION</legend>
                    {!! Form::textarea('destino',$produccion->destino,['class'=>'form-control','rows'=>'2','disabled'])!!}
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">COSTO Y FECHA</legend>
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! Form::label('Costo de la produccion')!!}
                            {!! Form::text('totalprecio',\App\Tool::convertMoney($produccion->totalPrecio()),['class'=>'form-control autonumber','disabled'])!!}
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class=" control-label">Fecha para la produccion</label>
                        {!! Form::text('fecha',$produccion->fecha,['class'=>'form-control input-daterange-timepicker','required','disabled'])!!}
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
