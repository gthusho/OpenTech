
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
        @include('cpanel.admin.usuario.partials.info')
    </div>
    <div class="col-lg-7">
        <div class="panel panel-border panel-custom">
            <div class="panel-heading">

                <h3 class="panel-title">Permisos</h3>

            </div>
            <div class="panel-body">
                @include('cpanel.admin.usuario.partials.permisos')
            </div>
        </div>
    </div>
</div>


