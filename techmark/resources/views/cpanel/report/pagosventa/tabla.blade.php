<h3>
    <br>
    <table>
        <br>
        <tr>
            <td width="30%">FECHA COMPRA</td>
            <td width="35%">{{$venta->registro}}</td>
        </tr>
        <tr>
            <td width="30%">CODIGO</td>
            <td width="20%">{{$venta->getCode()}}</td>
        </tr>
    </table>
</h3>
<br>
<table width="50%" style="line-height:20pt;">
    <tr>
        <td><strong>SUCURSAL:</strong></td>
        <td>{{$venta->sucursal->nombre}}</td>
    </tr>
    <tr>
        <td><strong>ALMACEN:</strong></td>
        <td>{{$venta->almacen->nombre}}</td>
    </tr>
    <tr>
        <td><strong>CLIENTE:</strong></td>
        <td>{{$venta->cliente->razon_social}}</td>
    </tr>
    <tr>
        <td><strong>NIT:</strong></td>
        <td>{{$venta->cliente->nit}}</td>
    </tr>

    <tr>
        <td><strong>TOTAL PRECIO</strong></td>
        <td>{{\App\Tool::convertMoney($venta->totalPrecio())}}</td>
    </tr>
    <tr>
        <td><strong>SALDO:</strong></td>
        <td>{{\App\Tool::convertMoney($venta->getTotalDeuda())}}</td>
    </tr>
    <tr>
        <td><strong>REGISTRADO:</strong></td>
        <td>{{$venta->usuario->nombre}}</td>
    </tr>

</table>
<P></P>

<table  cellspacing="5">
    <tr>
        <th width="10%" ><strong>#</strong></th>
        <th width="30%" ><strong>FECHA</strong></th>
        <th width="30%" ><strong>REGISTRO</strong></th>
        <th width="30%" ><strong>MONTO</strong></th>
    </tr>
    <?php
    $i=1;
    ?>

    @foreach($venta->pagos as $row)
        <tr >
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">
                {{($row->fecha)}}
            </td>
            <td style="border-bottom: 1px dashed black;">
                {{$row->usuario->nombre}}
            </td>
            <td style="border-bottom: 1px dashed black;">
                {{\App\Tool::convertMoney($row->abono)}}
            </td>

        </tr>
    @endforeach

</table>
<P></P>
<table>
    <tr>
        <td width="72%" ><strong>TOTAL PAGADO:</strong></td>
        <td>{{\App\Tool::convertMoney($venta->totalPrecio() - $venta->getTotalDeuda())}}</td>
    </tr>
    <tr>
        <td width="72%" ><strong>SALDO:</strong></td>
        <td><b>{{\App\Tool::convertMoney($venta->getTotalDeuda())}}</b></td>
    </tr>


</table>



