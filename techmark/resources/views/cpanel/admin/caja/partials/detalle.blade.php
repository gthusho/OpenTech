<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h4 class="panel-title">VENTAS ARTICULOS</h4>
    </div>
    <div class="panel-body">
            <table class="table table-hover">
                <tr>
                    <td width="50%" ><h5>Ventas de Articulos al Contado</h5></td>
                    <td width="15%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
                </tr>
                <tr>
                    <td width="50%" ><h5>Ventas de Articulos con Tarjeta</h5></td>
                    <td width="15%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
                </tr>
                <tr>
                    <td width="50%" ><h5>Ventas de Articulos con Cheque</h5></td>
                    <td width="15%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
                </tr>
                <tr>
                    <td width="50%" ><h5>Ventas de Articulos al Credito</h5></td>
                    <td width="15%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
                </tr>
            </table>
            <table  cellspacing="5">

                @foreach($caja as $row)

                @endforeach

            </table>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h4 class="panel-title">VENTAS DE PRODUCTOS</h4>
    </div>
    <div class="panel-body">
        <TABLE class="table table-hover">
        <tr>
            <td width="50%"><h5>Ventas de Productos al Contado</h5></td>
            <td width="15%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <tr>
            <td width="50%" ><h5>Ventas de Productos con Tarjeta</h5></td>
            <td width="15%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <tr>
            <td width="50%" ><h5>Ventas de Productos con Cheque</h5></td>
            <td width="15%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <tr>
            <td width="50%" ><h5>Ventas de Productos al Credito</h5></td>
            <td width="15%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        </TABLE>

    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h4 class="panel-title">PAGOS DE VENTAS</h4>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tr>
                <td width="50%" ><h5>Pagos de Articulos</h5></td>
                <td width="15%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
            </tr>
            <tr>
                <td width="50%" ><h5>Pagos de Productos</h5></td>
                <td width="15%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h4 class="panel-title">TOTALES</h4>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
        <tr>
            <td width="83%"><h5>Total de Ingresos</h5></td>
            <td width="20%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <tr>
            <td width="83%"><h5>Total de Gastos</h5></td>
            <td width="20%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <tr>
            <td width="83%"><h5>Total (I - G)</h5></td>
            <td width="20%" class="text-right"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <P></P>
        <tr>
            <td width="83%"><h5>Efectivo en Caja</h5></td>
            <td width="20%" class="text-right"><strong>{{\App\Tool::convertMoney(1000)}}</strong></td>
        </tr>
        </table>
    </div>
</div>