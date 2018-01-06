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
    <div class="col-lg-4">
        @include('cpanel.admin.produccion.partials.infoProduccion')
    </div>
    <div class="col-lg-8">
        <div class="panel panel-border panel-custom">
            <div class="panel-heading">

                <h3 class="panel-title">INFORMACION ARTICULOS</h3>

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        @include('cpanel.admin.produccion.partials.buscarArticulo')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        @include('cpanel.admin.produccion.partials.infoArticulo')
                    </div>
                    <div class="col-lg-9">
                        @include('cpanel.admin.produccion.partials.infoPrecios')
                    </div>
                    <div class="col-lg-3">
                        @include('cpanel.admin.produccion.partials.operaciones')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


