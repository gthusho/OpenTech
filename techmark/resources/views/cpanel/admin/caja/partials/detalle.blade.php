<div class="panel panel-border panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">VENTAS ARTICULOS</h4>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tr>
                <td width="50%" ><h5>Ventas de Articulos al Contado</h5></td>
                <td width="15%" class="text-right"><h5>{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Contado'))}}</h5></td>
            </tr>
            <tr>
                <td width="50%" ><h5>Ventas de Articulos con Tarjeta</h5></td>
                <td width="15%" class="text-right"><h5>{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Tarjeta Credito'))}}</h5></td>
            </tr>
            <tr>
                <td width="50%" ><h5>Ventas de Articulos con Cheque</h5></td>
                <td width="15%" class="text-right"><h5>{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Cheque'))}}</h5></td>
            </tr>
            <tr>
                <td width="50%" ><h5>Ventas de Articulos al Credito</h5></td>
                <td width="15%" class="text-right"><h5>{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Credito'))}}</h5></td>
            </tr>
            <tr>
                <td width="50%" class="text-right"><h4>TOTAL</h4></td>
                <td width="15%" class="text-right"><h4>{{\App\Tool::convertMoney($caja->totalVentasArticulos())}}</h4></td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-border panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">VENTAS DE PRODUCTOS</h4>
    </div>
    <div class="panel-body">
        <TABLE class="table table-hover">
            <tr>
                <td width="50%"><h5>Ventas de Productos al Contado</h5></td>
                <td width="15%" class="text-right"><h5>{{\App\Tool::convertMoney(0)}}</h5></td>
            </tr>
            <tr>
                <td width="50%" ><h5>Ventas de Productos con Tarjeta</h5></td>
                <td width="15%" class="text-right"><h5>{{\App\Tool::convertMoney(0)}}</h5></td>
            </tr>
            <tr>
                <td width="50%" ><h5>Ventas de Productos con Cheque</h5></td>
                <td width="15%" class="text-right"><h5>{{\App\Tool::convertMoney(0)}}</h5></td>
            </tr>
            <tr>
                <td width="50%" ><h5>Ventas de Productos al Credito</h5></td>
                <td width="15%" class="text-right"><h5>{{\App\Tool::convertMoney(0)}}</h5></td>
            </tr>
            <tr>
                <td width="50%" class="text-right"><h4>TOTAL</h4></td>
                <td width="15%" class="text-right"><h4>{{\App\Tool::convertMoney(0)}}</h4></td>
            </tr>
        </TABLE>

    </div>
</div>
<div class="panel panel-border panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">PAGOS DE VENTAS AL CREDITO</h4>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tr>
                <td width="50%" ><h5>Pagos de Articulos</h5></td>
                <td width="15%" class="text-right"><h5>{{\App\Tool::convertMoney($caja->totalPagoCreArt())}}</h5></td>
            </tr>
            <tr>
                <td width="50%" ><h5>Pagos de Productos</h5></td>
                <td width="15%" class="text-right"><h5>{{\App\Tool::convertMoney(0)}}</h5></td>
            </tr>
            <tr>
                <td width="50%" class="text-right"><h4>TOTAL</h4></td>
                <td width="15%" class="text-right"><h4>{{\App\Tool::convertMoney($caja->totalPgVntCredit())}}</h4></td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-border panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">TOTALES</h4>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tr>
                <td width="83%"><h5>Total de Ingresos</h5></td>
                <td width="20%" class="text-right"><h5>{{\App\Tool::convertMoney($caja->totalIngresos())}}</h5></td>
            </tr>
            <tr>
                <td width="83%"><h5>Total de Gastos</h5></td>
                <td width="20%" class="text-right"><h5>{{\App\Tool::convertMoney($caja->totalGastos())}}</h5></td>
            </tr>
            <tr>
                <td width="83%"><h5>Total (I - G)</h5></td>
                <td width="20%" class="text-right"><h5>{{\App\Tool::convertMoney($caja->totalIG())}}</h5></td>
            </tr>
            <tr>
                <td width="83%"><h5>Efectivo en Caja</h5></td>
                <td width="20%" class="text-right"><h5>{{\App\Tool::convertMoney(($caja->totalIG() + $caja->apertura))}}</h5></td>
            </tr>
        </table>
    </div>
</div>