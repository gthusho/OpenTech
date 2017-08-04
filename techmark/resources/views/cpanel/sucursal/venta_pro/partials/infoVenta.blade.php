<?php
$cambioX = 0;
$abonoEdit = '';
if(Request::segment(5)=='edit'){
    $xmonto =  ($venta->abono - $venta->totalPrecio());
    if($xmonto <0 && $venta->tipo_pago=='Credito'){
        $cambioX = "A Credito ".($xmonto * -1) ;

    }else{
        $cambioX = \App\Tool::convertMoney($xmonto);
    }
    $abonoEdit = 'disabled';
}
?>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">VENTA {{$venta->getCode()}}</h3>
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
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">SUCURSAL QUE REALIZA LA VENTA</legend>
                    {!! Form::text('sucursal',$sucursal,['class'=>'form-control','disabled'])!!}

                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">TIPO VENTA</legend>
                    {!! Form::select('tipo_pago',Config::get('gthusho.tipo_compra'),null,['class'=>'form-control select2','required','id'=>'tipo_pago',$abonoEdit])!!}

                </fieldset>
            </div>
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">OBSERVACIONES</legend>
                    {!! Form::textarea('observaciones',null,['class'=>'form-control','rows'=>'4'])!!}
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">PRECIOS Y CANTIDAD</legend>
                   {{--<div class="row">--}}
                       {{--<div class="form-group col-lg-12">--}}
                           {{--{!! Form::label('Cantidad Articulos  ')!!}--}}
                           {{--{!! Form::text('totalcantidad',$venta->totalCantidad(),['class'=>'form-control ','disabled'])!!}--}}
                       {{--</div>--}}
                   {{--</div>--}}
                    <div class="row">
                        <div class="form-group m-t-5">
                            <label for="totalprecio" class="col-md-2 control-label">Total</label>
                            <div class="col-md-10">
                                {!! Form::text('totalprecio',\App\Tool::convertMoney($venta->totalPrecio()),['class'=>'form-control autonumber','disabled','id'=>'totalprecio'])!!}

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group m-t-5">
                            <label for="abono" class="col-md-2 control-label">Efectivo</label>
                            <div class="col-md-10">
                                {!! Form::text('abono',null,['class'=>'form-control autonumber','required','id'=>'abono','autocomplete'=>'off',$abonoEdit])!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group m-t-5">
                            <label for="abono" class="col-md-2 control-label">Cambio</label>
                            <div class="col-md-10">
                                {!! Form::text('cambio',$cambioX,['class'=>'form-control ','required','id'=>'cambio','disabled'])!!}
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
