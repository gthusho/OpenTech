
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
    <div class="col-lg-5">
        @include('cpanel.admin.venta_producto_credito.partials.infoVenta')
    </div>
    <div class="col-lg-7">
        <div class="panel panel-border panel-custom">
            <div class="panel-heading">

                <h3 class="panel-title">PAGOS REALIZADOS</h3>

            </div>
            <div class="panel-body">
                @include('cpanel.admin.venta_producto_credito.partials.table')
            </div>
        </div>
    </div>
</div>


