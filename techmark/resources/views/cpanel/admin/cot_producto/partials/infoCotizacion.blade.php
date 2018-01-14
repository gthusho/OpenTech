<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">COTIZACION {{$cotizacion->getCode()}}</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">DATOS CLIENTE</legend>
                    <div class="form-group col-lg-6">
                        {!! Form::label('NIT ')!!}
                        {!! Form::text('nit',$nit,['class'=>'form-control','autocomplete'=>'of','id'=>'xnit'])!!}
                    </div>
                    <div class="form-group col-lg-6">
                        {!! Form::label('Cliente ')!!}
                        {!! Form::text('razon_social',$razon_social,['class'=>'form-control','disabled','id'=>'crazon'])!!}
                    </div>
                    <div class="form-group col-lg-4">
                        {!! Form::hidden('cliente_id',null,['class'=>'form-control ','id'=>'cid'])!!}
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">SUCURSAL QUE REALIZA LA COTIZACION</legend>
                    {!! Form::select('sucursal_id',$sucursales,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione una sucursal','id'=>'Csucursal'])!!}

                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">FECHA LIMITE DE VALIDEZ</legend>
                    {!! Form::text('fvalides',null,['class'=>'form-control','','autocomplete'=>"off",'id'=>"datepicker-autoclose",'data-date-format'=>'yyyy/mm/dd','required'])!!}
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">PRECIOS Y CANTIDAD</legend>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('Total Precio ')!!}
                            {!! Form::text('totalprecio',\App\Tool::convertMoney($cotizacion->totalPrecio()),['class'=>'form-control autonumber','disabled'])!!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('Cantidad Productos  ')!!}
                            {!! Form::text('totalcantidad',$cotizacion->totalCantidad(),['class'=>'form-control ','disabled'])!!}
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
