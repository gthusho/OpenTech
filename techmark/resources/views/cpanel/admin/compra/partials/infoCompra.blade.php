<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">INFORMACION DE LA COMPRA</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">SUCURSAL QUE REALIZA LA COMPRA</legend>
                    {!! Form::select('sucursal_id',$sucursales,Session::get('cSucursal'),['class'=>'form-control select2','required','placeholder'=>'Seleccione una sucursal'])!!}

                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">FECHA DE COMPRA</legend>
                    <div class="input-group">
                        {!! Form::text('fecha',Session::get('cFecha'),['class'=>'form-control','required','autocomplete'=>"off",'id'=>"datepicker-autoclose",'data-date-format'=>'yyyy/mm/dd'])!!}
                        <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                    </div>
                </fieldset>
            </div>
            <div class="col-lg-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">ALMACEN</legend>
                    {!! Form::select('almacen_id',$almacenes,Session::get('cAlmacen'),['class'=>'form-control select2','required','placeholder'=>'Seleccione un almacen'])!!}
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">DATOS PROVEEDOR</legend>
                    <div class="form-group col-lg-8">
                        {!! Form::label('Proveedor ')!!}
                        {!! Form::select('proveedor',$proveedores,Session::get('cProveedor'),['class'=>'form-control select2','required','placeholder'=>'Seleccione un Proveedor'])!!}
                    </div>
                    <div class="form-group col-lg-4">
                        {!! Form::label('# Factura ')!!}
                        {!! Form::text('nfactura',Session::get('cFactura'),['class'=>'form-control','autocomplete'=>'off'])!!}
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
                            {!! Form::text('totalcosto',$totalPrice,['class'=>'form-control autonumber','disabled'])!!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {!! Form::label('Cantidad Articulos  ')!!}
                            {!! Form::text('totalcantidad',$totalQty,['class'=>'form-control ','disabled'])!!}
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
