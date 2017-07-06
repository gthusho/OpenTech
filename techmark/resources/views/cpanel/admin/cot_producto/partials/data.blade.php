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
        @include('cpanel.admin.cot_producto.partials.infoCotizacion')
    </div>
    <div class="col-lg-7">
        <div class="panel panel-border panel-custom">
            <div class="panel-heading">

                <h3 class="panel-title">INFORMACION PRODUCTO</h3>

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="row">
                            @include('cpanel.admin.cot_producto.partials.infoProducto')
                        </div>
                        <div class="row">
                            @include('cpanel.admin.cot_producto.partials.operaciones')
                        </div>
                    </div>
                    <div class="col-lg-5">
                        @include('cpanel.admin.cot_producto.partials.infoCantidad')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function fncSumar(){
        var numero1 = Number(document.getElementById("xcantidad").value);
        var numero2 = Number(document.getElementById("pelprecio").value);
        document.getElementById("xprecio").value = numero1*numero2;
    }
</script>


