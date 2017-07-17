<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h4 class="panel-title">VENTAS ARTICULOS</h4>
    </div>
    <div class="panel-body">
        <ul class="list-unstyled">
            <P></P>

            <table>
                <tr>
                    <td width="50%" ><strong>Ventas de Articulos al Contado</strong></td>
                    <td width="15%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
                </tr>
                <tr>
                    <td width="50%" ><strong>Ventas de Articulos con Tarjeta</strong></td>
                    <td width="15%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
                </tr>
                <tr>
                    <td width="50%" ><strong>Ventas de Articulos con Cheque</strong></td>
                    <td width="15%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
                </tr>
                <tr>
                    <td width="50%" ><strong>Ventas de Articulos al Credito</strong></td>
                    <td width="15%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
                </tr>
            </table>
            <P></P>
            <table  cellspacing="5">

                @foreach($caja as $row)

                @endforeach

            </table>

        </ul>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h4 class="panel-title">VENTAS DE PRODUCTOS</h4>
    </div>
    <div class="panel-body">
        <TABLE>
        <tr>
            <td width="50%"><strong>Ventas de Productos al Contado</strong></td>
            <td width="15%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <tr>
            <td width="50%" ><strong>Ventas de Productos con Tarjeta</strong></td>
            <td width="15%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <tr>
            <td width="50%" ><strong>Ventas de Productos con Cheque</strong></td>
            <td width="15%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <tr>
            <td width="50%" ><strong>Ventas de Productos al Credito</strong></td>
            <td width="15%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        </TABLE>

    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h4 class="panel-title">PAGOS DE VENTAS</h4>
    </div>
    <div class="panel-body">
        <table>
            <tr>
                <td width="88.7%" ><strong>Pagos de Articulos</strong></td>
                <td width="20%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
            </tr>
            <tr>
                <td width="88.7%" ><strong>Pagos de Productos</strong></td>
                <td width="20%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h4 class="panel-title">TOTALES</h4>
    </div>
    <div class="panel-body">
        <table>
        <tr>
            <td width="83%"><strong>Total de Ingresos</strong></td>
            <td width="20%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <tr>
            <td width="83%"><strong>Total de Gastos</strong></td>
            <td width="20%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <tr>
            <td width="83%"><strong>Total (I - G)</strong></td>
            <td width="20%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <P></P>
        <tr>
            <td width="83%"><strong>Efectivo en Caja</strong></td>
            <td width="20%" ><strong>{{\App\Tool::convertMoney(1000)}}</strong></td>
        </tr>
        </table>
    </div>
</div>