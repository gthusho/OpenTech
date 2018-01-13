<div id="modal_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static" data-focus-on="input:first">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Registrar Cliente</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mAlert" >

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="xNit" class="control-label">Nit</label>
                            <input type="text" class="form-control limpiar"  name="xNit" id='xxNit' required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="xNombreCliente" class="control-label">Razon Social de cliente</label>
                            <input type="text" class="form-control limpiar"  name="xNombreCliente" id="xxNombreCliente" required autofocus>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group ">
                            {!! Form::label('Teléfono')!!}
                            {!! Form::text('xtelefono',null,['class'=>'form-control limpiar','id'=>'xtelefono'])!!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group ">
                            {!! Form::label('Dirección')!!}
                            {!! Form::text('xdireccion',null,['class'=>'form-control limpiar','id'=>'xdireccion'])!!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('Email')!!}
                            {!! Form::text('xemail',null,['class'=>'form-control limpiar','id'=>'xemail'])!!}
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-info waves-effect waves-light" id="cliente_registrar">Registrar</button>
            </div>
        </div>
    </div>
</div>