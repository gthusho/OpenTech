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
                    {!! Form::text('sucursal',$sucursal,['class'=>'form-control','disabled','id'=>'sucursal'])!!}
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">TIPO VENTA</legend>
                    {!! Form::select('tipo_pago',Config::get('gthusho.tipo_compra'),null,['class'=>'form-control select2','required'])!!}
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
