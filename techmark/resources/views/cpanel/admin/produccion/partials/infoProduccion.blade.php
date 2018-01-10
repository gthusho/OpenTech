<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">PRODUCCION {{$produccion->getCode()}}</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">SUCURSAL QUE REALIZA LA PRODUCCION</legend>
                    {!! Form::select('sucursal_id',$sucursales,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione una sucursal','id'=>'Psucursal'])!!}
                </fieldset>
            </div>
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">TRABAJADOR QUE REALIZA LA PRODUCCION</legend>
                    {!! Form::select('trabajador_id',$trabajadores,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione un trabajador','id'=>'Ptrabajador'])!!}

                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">DESTINADO A</legend>
                    {!! Form::textarea('destino',null,['class'=>'form-control','rows'=>'2','id'=>'Pdestino'])!!}
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <label class=" control-label">Fecha Realizacion de la produccion *</label>
                {!! Form::text('fecha',null,['class'=>'form-control input-daterange-timepicker','required','id'=>'Pfecha'])!!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">PRECIOS Y CANTIDAD</legend>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('Total Precio ')!!}
                            {!! Form::text('totalprecio',\App\Tool::convertMoney($produccion->totalPrecio()),['class'=>'form-control autonumber','disabled'])!!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('Cantidad Articulos  ')!!}
                            {!! Form::text('totalcantidad',$produccion->totalCantidad(),['class'=>'form-control ','disabled'])!!}
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
