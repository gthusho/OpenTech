<table width="50%">
    <tr>
        <td><strong>FECHA COMPRA</strong></td>
        <td >{{$venta->registro}}</td>
    </tr>
    <tr>
        <td ><strong>CODIGO</strong></td>
        <td >{{$venta->getCode()}}</td>
    </tr>
    <tr>
        <td><strong>SUCURSAL:</strong></td>
        <td>{{$venta->sucursal->nombre}}</td>
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
                {{date('d/m/Y',strtotime($venta->fecha))}}
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
<table   width="95%">
    <tr>
        <td align="right" ><strong>TOTAL PAGADO:</strong></td>
        <td align="right">{{\App\Tool::convertMoney($venta->totalPrecio() - $venta->getTotalDeuda())}}</td>
    </tr>
    <tr>
        <td align="right"  ><strong>SALDO:</strong></td>
        <td align="right"><b>{{\App\Tool::convertMoney($venta->getTotalDeuda())}}</b></td>
    </tr>
</table>
<table width="40%">
    <tr>
        <td align="center">{{$venta->sucursal->nombre}}- {{$venta->sucursal->ciudad->nombre}}</td>
    </tr>
    <tr>
        <td align="center">Tel: {{$venta->sucursal->telefono}} - Dir: {{$venta->sucursal->direccion}}</td>
    </tr>
    <tr >
        <td align="center"> <b>Gracias por su Preferencia!!</b></td>
    </tr>
</table>



