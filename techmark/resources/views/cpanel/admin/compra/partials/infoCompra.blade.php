<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">COMPRA {{$compra->getCode()}}</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">SUCURSAL QUE REALIZA LA COMPRA</legend>
                    {!! Form::select('sucursal_id',$sucursales,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione una sucursal'])!!}

                </fieldset>
            </div>
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">TIPO COMPRA</legend>
                    {!! Form::select('tipo_compra',Config::get('gthusho.tipo_compra'),null,['class'=>'form-control select2','required'])!!}

                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">FECHA DE COMPRA</legend>
                    <div class="input-group">
                        {!! Form::text('fecha',null,['class'=>'form-control','required','autocomplete'=>"off",'id'=>"datepicker-autoclose",'data-date-format'=>'yyyy/mm/dd'])!!}
                        <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                    </div>
                </fieldset>
            </div>
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">ALMACEN</legend>
                    {!! Form::select('almacen_id',$almacenes,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione un almacen'])!!}
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">DATOS PROVEEDOR</legend>
                    <div class="form-group col-lg-8">
                        {!! Form::label('Proveedor ')!!}
                        {!! Form::select('proveedor_id',$proveedores,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione un Proveedor'])!!}
                    </div>
                    <div class="form-group col-lg-4">
                        {!! Form::label('# Factura ')!!}
                        {!! Form::text('nfactura',null,['class'=>'form-control','autocomplete'=>'off'])!!}
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">COSTOS Y CANTIDAD</legend>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('Total Costos ')!!}
                            {!! Form::text('totalcosto',\App\Tool::convertMoney($compra->totalCosto()),['class'=>'form-control autonumber','disabled'])!!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('Cantidad Articulos  ')!!}
                            {!! Form::text('totalcantidad',$compra->totalCantidad(),['class'=>'form-control ','disabled'])!!}
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
