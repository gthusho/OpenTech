<table width="40%" >
    <tr>
        <td ><strong>FECHA</strong></td>
        <td >{{$compra->fecha}}</td>
    </tr>

    <tr>
        <td ><strong>CODIGO</strong></td>
        <td >{{$compra->getCode()}}</td>
    </tr>
    <tr>
        <td><strong>SUCURSAL:</strong></td>
        <td>{{$compra->sucursal->nombre}}</td>
    </tr>
    <tr>
        <td><strong>ALMACEN:</strong></td>
        <td>{{$compra->almacen->nombre}}</td>
    </tr>
    <tr>
        <td><strong>PROVEEDOR:</strong></td>
        <td>{{$compra->proveedor->razon_social}}</td>
    </tr>
    <tr>
        <td><strong>CANTIDAD:</strong></td>
        <td>{{ucwords($compra->totalCantidad())}}</td>
    </tr>
    <tr>
        <td><strong>TOTAL PRECIO</strong></td>
        <td>{{\App\Tool::convertMoney($compra->totalCosto())}}</td>
    </tr>
    <tr>
        <td><strong>SALDO:</strong></td>
        <td>{{\App\Tool::convertMoney($compra->getTotalDeuda())}}</td>
    </tr>
    <tr>
        <td><strong>REGISTRADO:</strong></td>
        <td>{{$compra->usuario->nombre}}</td>
    </tr>

</table>
<br>
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

    @foreach($compra->pagos as $row)
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
<table>
    <tr>
        <td width="50%" align="righ"><strong>TOTAL PAGADO: </strong></td>
        <td align="center">{{\App\Tool::convertMoney($compra->totalCosto() - $compra->getTotalDeuda())}}</td>
    </tr>
    <tr>
        <td width="50%" align="right"><strong>SALDO: </strong></td>
        <td align="center"><b>{{\App\Tool::convertMoney($compra->getTotalDeuda())}}</b></td>
    </tr>
</table>
<table width="40%">
    <tr>
        <td align="center">{{$compra->sucursal->nombre}}- {{$compra->sucursal->ciudad->nombre}}</td>
    </tr>
    <tr>
        <td align="center">Tel: {{$compra->sucursal->telefono}} - Dir: {{$compra->sucursal->direccion}}</td>
    </tr>
    <tr >
        <td align="center"> <b>Gracias por su Preferencia!!</b></td>
    </tr>
</table>
