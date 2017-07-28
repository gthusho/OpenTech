
<div class="row">
    <div class="col-lg-5">
        @include('cpanel.admin.caja.partials.infcaja')
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-left m-t-15">
                    <a onclick="printJS('{{url('reportes/caja/detalle').'?id='.$caja->id}}')"
                       class="btn btn-inverse  waves-effect waves-light">Detalle
                        <span class="m-l-5"><i class=" icon-printer"></i></span></a>
                </div>
                <div class="btn-group pull-left m-t-15 m-l-5">
                    <button onclick="printJS('{{url('reportes/caja/general').'?id='.$caja->id}}')"
                       class="btn btn-inverse  waves-effect waves-light">Imprimir
                        <span class="m-l-5"><i class="icon-printer"></i></span></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
                @include('cpanel.admin.caja.partials.detalle')
    </div>
</div>