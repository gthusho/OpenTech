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
                            <th>IMAGEN</th>
                            <th>PRODUCTO</th>
                            <th>TALLA</th>
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