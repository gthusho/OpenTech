<h3 class="panel-title">INFORMACION CAJA</h3>
<div class="panel-body">
        <table>
            <tr>
                <td width="30%"><strong>FECHA APERTURA:</strong></td>
                <td width="70%">{{$caja->registro}}</td>
            </tr>
            <tr>
                <td width="30%"><strong>FECHA DE CIERRE:</strong></td>
                <td width="70%">{{$caja->fcierre}}</td>
            </tr>
            <tr>
                <td><strong>USUARIO CAJA:</strong></td>
                <td>{{$caja->usuario->nombre}}</td>
            </tr>
            <tr>
                <td><strong>SUCURSAL:</strong></td>
                <td>{{$caja->sucursal->nombre}}</td>
            </tr>
            <tr>
                <td><strong>MONTO DE APERTURA:</strong></td>
                <td>{{\App\Tool::convertMoney($caja->apertura)}}</td>
            </tr>
            <tr>
                <td><strong>MONTO DE CIERRE:</strong></td>
                <td>{{\App\Tool::convertMoney($caja->cierre)}}</td>
            </tr>
            <tr>
                <td><strong>OBSERVACIONES:</strong></td>
                <td>{{$caja->observaciones}}</td>
            </tr>
        </table>
        <table  cellspacing="5">

            @foreach($caja->sucursal as $row)

            @endforeach

        </table>
</div>
<h4 class="panel-title">VENTAS ARTICULOS</h4>
<div class="panel-body">
    <table class="table table-hover">
        <tr>
            <td width="50%" ><h4>Ventas de Articulos al Contado</h4></td>
            <td width="15%" class="text-right">{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Contado'))}}</td>
        </tr>
        <tr>
            <td width="50%" ><h4>Ventas de Articulos con Tarjeta</h4></td>
            <td width="15%" class="text-right">{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Tarjeta Credito'))}}</td>
        </tr>
        <tr>
            <td width="50%" ><h4>Ventas de Articulos con Cheque</h4></td>
            <td width="15%" class="text-right">{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Cheque'))}}</td>
        </tr>
        <tr>
            <td width="50%" ><h4>Ventas de Articulos al Credito</h4></td>
            <td width="15%" class="text-right">{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Credito'))}}</td>
        </tr>
        <tr>
            <td width="50%" class="text-right"><h4>TOTAL</h4></td>
            <td width="15%" class="text-right">{{\App\Tool::convertMoney($caja->totalVentasArticulos())}}</td>
        </tr>
    </table>
</div>
<h4 class="panel-title">VENTAS DE PRODUCTOS</h4>
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
<h4 class="panel-title">PAGOS DE VENTAS</h4>
<div class="panel-body">
    <table>
        <tr>
            <td ><strong>Pagos de Articulos</strong></td>
            <td ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
        <tr>
            <td><strong>Pagos de Productos</strong></td>
            <td width="20%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>
    </table>
</div>
<h4 class="panel-title">TOTALES</h4>
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