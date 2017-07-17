
<style>

    fieldset{
        margin-bottom: 2px;
    }
    fieldset.scheduler-border {
        border: solid 1px #DDD !important;
        padding: 0 5px 7px 5px;
        border-bottom: none;
    }

    legend.scheduler-border {
        width: auto !important;
        border: none;
        font-size: 10px;
        margin-bottom: 0px;
    }
    label{
        font-size: 12px !important;

    }
    .form-group{
        margin-bottom: 0px !important;
    }
</style>
<div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    <a href="{{url('reportes/caja/detalle').'?id='.$caja->id}}"
                       class="btn btn-inverse  waves-effect waves-light" target="_blank" >Detalle
                        <span class="m-l-5"><i class=" icon-printer"></i></span></a>
                </div>
                <div class="btn-group pull-right m-t-15 m-r-5">
                    <a href="{{url('reportes/caja/general').'?id='.$caja->id}}"
                       class="btn btn-inverse  waves-effect waves-light" target="_blank">Imprimir
                        <span class="m-l-5"><i class="icon-printer"></i></span></a>
                </div>
            </div>
</div>
<br>
<div class="row">
    <div class="col-lg-5">
        @include('cpanel.admin.caja.partials.infcaja')
    </div>
    <div class="col-lg-7">
        <div class="panel panel-border panel-custom">
                       <div class="panel-body">
                @include('cpanel.admin.caja.partials.detalle')
            </div>
        </div>
    </div>
</div>