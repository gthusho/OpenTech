<h3 class="panel-title">INFORMACION </h3>
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
    <table CELLSPACING="5" class="table table-hover">
        <tr>
            <td style="border-bottom: 1px dashed black;">Ventas de Articulos al Contado</td>
            <td align="rigth" style="border-bottom: 1px dashed black;" >{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Contado'))}}</td>
        </tr>
        <tr>
            <td  style="border-bottom: 1px dashed black;">Ventas de Articulos con Tarjeta</td>
            <td  align="rigth" style="border-bottom: 1px dashed black;" >{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Tarjeta Credito'))}}</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px dashed black;">Ventas de Articulos con Cheque</td>
            <td align="rigth" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Cheque'))}}</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px dashed black;">Ventas de Articulos al Credito</td>
            <td  align="rigth" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Credito'))}}</td>
        </tr>
        <tr>
            <td ><h4>TOTAL</h4></td>
            <td  align="rigth"><H4> {{\App\Tool::convertMoney($caja->totalVentasArticulos())}}</H4></td>
        </tr>
    </table>
</div>
<h4 class="panel-title">VENTAS DE PRODUCTOS</h4>
<div class="panel-body">
    <TABLE cellspacing="5">
        <tr>
            <td  style="border-bottom: 1px dashed black;">Ventas de Productos al Contado</td>
            <td align="rigth" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney(0)}}</td>
        </tr>
        <tr>
            <td  style="border-bottom: 1px dashed black;">Ventas de Productos con Tarjeta</td>
            <td align="rigth" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney(0)}}</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px dashed black;">Ventas de Productos con Cheque</td>
            <td  align="rigth" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney(0)}}</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px dashed black;">Ventas de Productos al Credito</td>
            <td align="rigth" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney(0)}}</td>
        </tr>
    </TABLE>
</div>
<h4 class="panel-title">PAGOS DE VENTAS</h4>
<div class="panel-body">
    <table cellspacing="5" class="table table-hover">
        <tr>
            <td style="border-bottom: 1px dashed black;">Pagos de Articulos</td>
            <td  align="rigth" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($caja->totalPagoCreArt())}}</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px dashed black;">Pagos de Productos</td>
            <td  align="rigth" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney(0)}}</td>
        </tr>
        <tr>
            <td ><h4>TOTAL</h4></td>
            <td  align="rigth" ><h4> {{\App\Tool::convertMoney($caja->totalPgVntCredit())}}</h4></td>
        </tr>
    </table>
</div>
<h4 class="panel-title">TOTALES</h4>
<div class="panel-body">
    <table cellspacing="5" class="table table-hover">
        <tr>
            <td style="border-bottom: 1px dashed black;">Total de Ingresos</td>
            <td  align="rigth" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($caja->totalIngresos())}}</td>
        </tr>
        <tr>
            <td  style="border-bottom: 1px dashed black;">Total de Gastos</td>
            <td  align="rigth" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($caja->totalGastos())}}</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px dashed black;">Total (I - G)</td>
            <td  align="rigth" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($caja->totalIG())}}</td>
        </tr>
        <tr>
            <td><h4>Efectivo en Caja</h4></td>
            <td align="rigth" ><h4>{{\App\Tool::convertMoney(($caja->totalIG() + $caja->apertura))}}</h4></td>
        </tr>
    </table>
</div>
