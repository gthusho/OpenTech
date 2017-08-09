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
</div>
<h4 class="panel-title">VENTAS ARTICULOS</h4>
<div class="panel-body">
    <h5 align="right"><strong><i><font size="8">VENTAS DE ARTICULOS AL CONTADO</font></i></strong></h5>
    <table border="0.1" >
        <tr>
            <td width="3%" align="center"><b><font size="8">#</font></b></td>
            <td width="10%" align="center"><b><font size="8">TIPO PAGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">CODIGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">FECHA</font></b></td>
            <td width="15%" align="center"><b><font size="8">SUCURSAL</font></b></td>
            <td width="15%" align="center"><b><font size="8">ALMACEN</font></b></td>
            <td width="15%" align="center"><b><font size="8">CLIENTE</font></b></td>
            <td width="13%" align="center"><b><font size="8">CANTIDAD ARTICULOS</font></b></td>
            <td width="10%" align="center"><b><font size="8">PRECIO TOTAL</font></b></td>
        </tr>
        <tr>
            <td align="right" colspan="8"><strong>TOTAL</strong></td>
            <td align="center"><strong>{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Contado'))}}</strong></td>
        </tr>

        <?php
        $i=1;
        ?>

        @foreach($caja as $row)

        @endforeach

    </table>
    <h5 align="right"><strong><i><font size="8">VENTAS DE ARTICULOS CON TARJETA</font></i></strong></h5>
    <table border="0.1">
        <tr>
            <td width="3%" align="center"><b><font size="8">#</font></b></td>
            <td width="10%" align="center"><b><font size="8">TIPO PAGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">CODIGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">FECHA</font></b></td>
            <td width="15%" align="center"><b><font size="8">SUCURSAL</font></b></td>
            <td width="15%" align="center"><b><font size="8">ALMACEN</font></b></td>
            <td width="15%" align="center"><b><font size="8">CLIENTE</font></b></td>
            <td width="13%" align="center"><b><font size="8">CANTIDAD ARTICULOS</font></b></td>
            <td width="10%" align="center"><b><font size="8">PRECIO TOTAL</font></b></td>
        </tr>
        <tr>
            <td align="right" colspan="8"><strong>TOTAL</strong></td>
            <td align="center"><strong>{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Tarjeta Credito'))}}</strong></td>
        </tr>

        <?php
        $i=1;
        ?>

        @foreach($caja as $row)

        @endforeach

    </table>
    <h5 align="right"><strong><i><font size="8">VENTAS DE ARTICULOS CON CHEQUE</font></i></strong></h5>
    <table border="0.1">
        <tr>
            <td width="3%" align="center"><b><font size="8">#</font></b></td>
            <td width="10%" align="center"><b><font size="8">TIPO PAGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">CODIGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">FECHA</font></b></td>
            <td width="15%" align="center"><b><font size="8">SUCURSAL</font></b></td>
            <td width="15%" align="center"><b><font size="8">ALMACEN</font></b></td>
            <td width="15%" align="center"><b><font size="8">CLIENTE</font></b></td>
            <td width="13%" align="center"><b><font size="8">CANTIDAD ARTICULOS</font></b></td>
            <td width="10%" align="center"><b><font size="8">PRECIO TOTAL</font></b></td>
        </tr>
        <tr>
            <td align="right" colspan="8"><strong>TOTAL</strong></td>
            <td align="center"><strong>{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Cheque'))}}</strong></td>
        </tr>

        <?php
        $i=1;
        ?>

        @foreach($caja as $row)

        @endforeach

    </table>
    <h5 align="right"><strong><i><font size="8">VENTAS DE ARTICULOS AL CREDITO</font></i></strong></h5>
    <table border="0.1">
        <tr>
            <td width="3%" align="center"><b><font size="8">#</font></b></td>
            <td width="10%" align="center"><b><font size="8">TIPO PAGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">CODIGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">FECHA</font></b></td>
            <td width="15%" align="center"><b><font size="8">SUCURSAL</font></b></td>
            <td width="15%" align="center"><b><font size="8">ALMACEN</font></b></td>
            <td width="15%" align="center"><b><font size="8">CLIENTE</font></b></td>
            <td width="13%" align="center"><b><font size="8">CANTIDAD ARTICULOS</font></b></td>
            <td width="10%" align="center"><b><font size="8">PRECIO TOTAL</font></b></td>
        </tr>
        <tr>
            <td align="right" colspan="8"><strong>TOTAL</strong></td>
            <td align="center"><strong>{{\App\Tool::convertMoney($caja->totalVentasArticulosByType('Credito'))}}</strong></td>
        </tr>

        <?php
        $i=1;
        ?>

        @foreach($caja as $row)

        @endforeach

    </table>
</div>
<h4 class="panel-title">VENTAS DE PRODUCTOS</h4>
<div class="panel-body">
    <h5 align="right"><strong><i><font size="8">VENTAS DE PRODUCTOS AL CONTADO</font></i></strong></h5>
    <table border="0.1">
        <tr>
            <td width="3%" align="center"><b><font size="8">#</font></b></td>
            <td width="10%" align="center"><b><font size="8">TIPO PAGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">CODIGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">FECHA</font></b></td>
            <td width="15%" align="center"><b><font size="8">SUCURSAL</font></b></td>
            <td width="15%" align="center"><b><font size="8">ALMACEN</font></b></td>
            <td width="15%" align="center"><b><font size="8">CLIENTE</font></b></td>
            <td width="13%" align="center"><b><font size="8">CANTIDAD</font></b></td>
            <td width="10%" align="center"><b><font size="8">PRECIO TOTAL</font></b></td>
        </tr>
        <tr>
            <td align="right" colspan="8"><strong>TOTAL</strong></td>
            <td align="center"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>

        <?php
        $i=1;
        ?>

        @foreach($caja as $row)

        @endforeach

    </table>
    <h5 align="right"><strong><i><font size="8">VENTAS DE PRODUCTOS CON TARJETA</font></i></strong></h5>
    <table border="0.1">
        <tr>
            <td width="3%" align="center"><b><font size="8">#</font></b></td>
            <td width="10%" align="center"><b><font size="8">TIPO PAGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">CODIGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">FECHA</font></b></td>
            <td width="15%" align="center"><b><font size="8">SUCURSAL</font></b></td>
            <td width="15%" align="center"><b><font size="8">ALMACEN</font></b></td>
            <td width="15%" align="center"><b><font size="8">CLIENTE</font></b></td>
            <td width="13%" align="center"><b><font size="8">CANTIDAD</font></b></td>
            <td width="10%" align="center"><b><font size="8">PRECIO TOTAL</font></b></td>
        </tr>
        <tr>
            <td align="right" colspan="8"><strong>TOTAL</strong></td>
            <td align="center"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>

        <?php
        $i=1;
        ?>

        @foreach($caja as $row)

        @endforeach

    </table>
    <h5 align="right"><strong><i><font size="8">VENTAS DE PRODUCTOS CON CHEQUE</font></i></strong></h5>
    <table border="0.1">
        <tr>
            <td width="3%" align="center"><b><font size="8">#</font></b></td>
            <td width="10%" align="center"><b><font size="8">TIPO PAGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">CODIGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">FECHA</font></b></td>
            <td width="15%" align="center"><b><font size="8">SUCURSAL</font></b></td>
            <td width="15%" align="center"><b><font size="8">ALMACEN</font></b></td>
            <td width="15%" align="center"><b><font size="8">CLIENTE</font></b></td>
            <td width="13%" align="center"><b><font size="8">CANTIDAD</font></b></td>
            <td width="10%" align="center"><b><font size="8">PRECIO TOTAL</font></b></td>
        </tr>
        <tr>
            <td align="right" colspan="8"><strong>TOTAL</strong></td>
            <td align="center"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>

        <?php
        $i=1;
        ?>

        @foreach($caja as $row)

        @endforeach

    </table>
    <h5 align="right"><strong><i><font size="8">VENTAS DE PRODUCTOS AL CREDITO</font></i></strong></h5>
    <table border="0.1">
        <tr>
            <td width="3%" align="center"><b><font size="8">#</font></b></td>
            <td width="10%" align="center"><b><font size="8">TIPO PAGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">CODIGO</font></b></td>
            <td width="10%" align="center"><b><font size="8">FECHA</font></b></td>
            <td width="15%" align="center"><b><font size="8">SUCURSAL</font></b></td>
            <td width="15%" align="center"><b><font size="8">ALMACEN</font></b></td>
            <td width="15%" align="center"><b><font size="8">CLIENTE</font></b></td>
            <td width="13%" align="center"><b><font size="8">CANTIDAD</font></b></td>
            <td width="10%" align="center"><b><font size="8">PRECIO TOTAL</font></b></td>
        </tr>
        <tr>
            <td align="right" colspan="8"><strong>TOTAL</strong></td>
            <td align="center"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
        </tr>

        <?php
        $i=1;
        ?>

        @foreach($caja as $row)

        @endforeach

    </table>
</div>
<h4 class="panel-title">PAGOS DE VENTAS</h4>
<div class="panel-body">
    <h5 align="right"><strong><i><font size="8">PAGOS DE ARTICULOS</font></i></strong></h5>

    <table  border="0.1">
        <tr>
            <td width="5%" align="center"><b><font size="8">#</font></b></td>
            <td width="12%" align="center"><b><font size="8">CODIGO</font></b></td>
            <td width="12%" align="center"><b><font size="8">FECHA</font></b></td>
            <td width="15%" align="center"><b><font size="8">SUCURSAL</font></b></td>
            <td width="20%" align="center"><b><font size="8">CANTIDAD</font></b></td>
            <td width="15%" align="center"><b><font size="8">COSTO TOTAL</font></b></td>
            <td width="10%" align="center"><b><font size="8">ABONO</font></b></td>
            <td width="10%" align="center"><b><font size="8">SALDO</font></b></td>
        </tr>
        <tr>
            <td align="right" colspan="7"><strong>TOTAL</strong></td>
            <td align="center"><strong>{{\App\Tool::convertMoney($caja->totalPagoCreArt())}}</strong></td>
        </tr>
        <?php
        $i=1;
        ?>
        @foreach($caja as $row)
        @endforeach
    </table>

    <h5 align="right"><strong><i><font size="8">PAGOS DE PRODUCTOS</font></i></strong></h5>
    <table  border="0.1">
        <tr>
            <td width="5%" align="center"><b><font size="8">#</font></b></td>
            <td width="12%" align="center"><b><font size="8">CODIGO</font></b></td>
            <td width="12%" align="center"><b><font size="8">FECHA</font></b></td>
            <td width="15%" align="center"><b><font size="8">SUCURSAL</font></b></td>
            <td width="20%" align="center"><b><font size="8">CANTIDAD</font></b></td>
            <td width="15%" align="center"><b><font size="8">COSTO TOTAL</font></b></td>
            <td width="10%" align="center"><b><font size="8">ABONO</font></b></td>
            <td width="10%" align="center"><b><font size="8">SALDO</font></b></td>
        </tr>
        <tr>
            <td align="right" colspan="7"><strong>TOTAL</strong></td>
            <td align="center"><strong>{{\App\Tool::convertMoney($caja->totalPgVntCredit())}}</strong></td>
        </tr>
        <?php
        $i=1;
        ?>
        @foreach($caja as $row)
        @endforeach
    </table>
</div>

<h4 class="panel-title">GASTOS</h4>



<table border="0.1">
    <tr >
        <td width="5%" align="center"><b><font size="8">#</font></b></td>
        <td width="15%" align="center"><b><font size="8">FECHA</font></b></td>
        <td width="15%" align="center"><b><font size="8">USUARIO</font></b></td>
        <td width="20%" align="center"><b><font size="8">SUCURSAL</font></b></td>
        <td width="30%" align="center"><b><font size="8">DESCRIPCION</font></b></td>
        <td width="15%" align="center"><b><font size="8">MONTO</font></b></td>
    </tr>
    <tr>
        <td align="right" colspan="5"><strong>TOTAL</strong></td>
        <td align="center"><strong>{{\App\Tool::convertMoney(0)}}</strong></td>
    </tr>
    <?php
    $i=1;
    ?>

    @foreach($caja as $row)
    @endforeach

</table>

<h4 class="panel-title">TOTALES</h4>
<div class="panel-body">
    <table>
        <tr>
            <td width="50%"><strong>TOTAL DE INGRESOS</strong></td>
            <th width="20%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></th>
        </tr>
        <tr>
            <td width="50%"><strong>TOTAL DE GASTOS</strong></td>
            <th width="20%" ><strong>{{\App\Tool::convertMoney(0)}}</strong></th>
        </tr>
        <tr>
            <td width="50%"><strong>TOTAL (I - G)</strong></td>
            <th width="15%" ><strong>{{\App\Tool::convertMoney($caja->totalIG())}}</strong></th>
        </tr>
        <tr>
            <td width="50%"><strong>EFECTIVO EN CAJA</strong></td>
            <th width="15%" ><strong>{{\App\Tool::convertMoney(($caja->totalIG() + $caja->apertura))}}</strong></th>
        </tr>
    </table>
</div>



