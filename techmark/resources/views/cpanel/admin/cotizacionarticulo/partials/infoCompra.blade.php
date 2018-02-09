<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">VENTA {{$venta->getCode()}}</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">DATOS CLIENTE</legend>
                    <div id="ci_1" style="display: block">
                        <div class="form-group col-lg-5">
                            {!! Form::label('NIT ')!!}
                            {!! Form::text('nit',$nit,['class'=>'form-control','autocomplete'=>'of','id'=>'xnit'])!!}
                        </div>
                        <div class="form-group col-lg-5">
                            {!! Form::label('Cliente ')!!}
                            {!! Form::text('razon_social',$razon_social,['class'=>'form-control','disabled','id'=>'crazon'])!!}
                        </div>
                        <div class="form-group col-lg-1">
                            <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm"  id="changeCombo"><i class="icon-reload"></i></span>
                        </div>
                        <div class="form-group col-lg-4">
                            {!! Form::hidden('cliente_id',null,['class'=>'form-control ','id'=>'cid'])!!}
                        </div>
                    </div>
                    <div id="ci_2" style="display: none">
                        <div class="form-group col-lg-10">
                            {!! Form::label('Cliente ')!!}
                            {!! Form::select('clientes',$todos_clientes,null,['class'=>'form-control select2','placeholder'=>'Seleccione un cliente','id'=>'combocliente'])!!}
                        </div>
                        <div class="form-group col-lg-1">
                            <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm"  id="changeNit"><i class="icon-reload"></i></span>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">SUCURSAL QUE REALIZA LA COTIZACION</legend>
                    {!! Form::select('sucursal_id',$sucursales,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione una sucursal'])!!}

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
                            {!! Form::text('totalprecio',\App\Tool::convertMoney($venta->totalPrecio()),['class'=>'form-control autonumber','disabled'])!!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('Cantidad Articulos  ')!!}
                            {!! Form::text('totalcantidad',$venta->totalCantidad(),['class'=>'form-control ','disabled'])!!}
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
