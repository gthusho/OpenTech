<div id="modal_search" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Buscador de  Articulos</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                        <button type="button" class="btn waves-effect waves-light btn-primary" id="buttonKeySearch"><i class="fa fa-search"></i></button>
                                                        </span>
                        <input type="text" id="xkeySearch" name="snombre" class="form-control" placeholder="Buscar">
                    </div>

                </div>
                <div class="row m-t-10">
                    <table class="table table-hover" >
                        <thead>
                        <tr>
                            <th>ARTICULO</th>
                            <th>CATEGORIA</th>
                            <th>MARCA</th>
                            <th>MATERIAL</th>
                        </tr>
                        </thead>

                        <tbody id="tablaRows">

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div id="modal_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
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
                            <input type="text" class="form-control limpiar"  name="xNombreCliente" id="xxNombreCliente" required>
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