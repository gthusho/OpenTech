
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
                @if($atm->check()==True && $atm->getEstado()=='p')
                    <div class="btn-group pull-right m-t-15 m-l-5">
                        <a href="{{route('s.caja.index')}}" class="btn btn-danger"><i class="icon-calculator"></i> <span> Cerrar Caja </span> </a>

                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="col-md-12">
            <div class="card-box">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @include('cpanel.admin.caja.partials.detalle')

</div>