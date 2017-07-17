
<div class="row">
    <div class="col-lg-5">
        @include('cpanel.admin.caja.partials.infcaja')
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-left m-t-15">
                    <a href="{{url('reportes/caja/detalle').'?id='.$caja->id}}"
                       class="btn btn-inverse  waves-effect waves-light" target="_blank" >Detalle
                        <span class="m-l-5"><i class=" icon-printer"></i></span></a>
                </div>
                <div class="btn-group pull-left m-t-15 m-l-5">
                    <a href="{{url('reportes/caja/general').'?id='.$caja->id}}"
                       class="btn btn-inverse  waves-effect waves-light" target="_blank">Imprimir
                        <span class="m-l-5"><i class="icon-printer"></i></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
                @include('cpanel.admin.caja.partials.detalle')
    </div>
</div>