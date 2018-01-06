<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">PRODUCCION CLIENTE {{$produccion->getCode()}}</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">SUCURSAL PRODUCCION</legend>
                    {!! Form::select('sucursal_id',$sucursales,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione una sucursal'])!!}
                </fieldset>
            </div>
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">TRABAJADOR PRODUCCION</legend>
                    {!! Form::select('trabajador_id',$trabajadores,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione un trabajador'])!!}

                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label class=" control-label">Cliente *</label>
                {!! Form::select('cliente_id',$clientes,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione un Cliente'])!!}
            </div>
            <div class="form-group col-lg-6">
                <label class=" control-label">Fecha de la produccion *</label>
                {!! Form::text('fecha',null,['class'=>'form-control input-daterange-timepicker','required'])!!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">DESTINADO A</legend>
                    {!! Form::textarea('destino',null,['class'=>'form-control','rows'=>'7'])!!}
                </fieldset>
            </div>
            <div class="col-lg-6">
                <div class="row">

                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">COSTO Y PRECIOS DE PRODUCCION</legend>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Costo</label>
                            <div class="col-md-9">
                                {!! Form::text('totalprecio',\App\Tool::convertMoney($produccion->totalPrecio()),['class'=>'form-control autonumber','disabled'])!!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Precio</label>
                            <div class="col-md-9">
                                {!! Form::text('precio',null,['class'=>'form-control autonumber','id'=>'Pprecio'])!!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3
                             control-label">Efectivo</label>
                            <div class="col-md-9">
                                {!! Form::text('adelanto',null,['class'=>'form-control','id'=>'Padelando'])!!}

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Saldo</label>
                            <div class="col-md-9">
                                {!! Form::text('saldo',($produccion->precio - $produccion->adelanto),['class'=>'form-control autonumber','disabled','id'=>'PSaldo'])!!}
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>


    </div>
</div>
