
<table>
    <tr>
        <td>COMPRA</td>
        <td>{{$compra->getCode()}}</td>
    </tr>
    <tr>
        <td>FECHA</td>
        <td>{{$compra->fecha}}</td>
    </tr>

    <tr>
        <td>SUCURSAL</td>
        <td>{{$compra->sucursal->nombre}}</td>
    </tr>
    <tr>
        <td>PROVEEDOR</td>
        <td>{{$compra->proveedor->razon_social}}</td>
    </tr>
    <tr>
        <td>CANTIDAD</td>
        <td>{{ucwords($compra->totalCantidad())}}</td>
    </tr>
    <tr>
        <td>COSTOS</td>
        <td>{{\App\Tool::convertMoney($compra->totalCosto())}}</td>
    </tr>
    <tr>
        <td>REGISTRADO</td>
        <td>{{$compra->usuario->nombre}}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
</table>
<table  cellspacing="5">
    <tr>
        <th width="5%" ><strong>#</strong></th>
        <th width="15%" ><strong>FECHA</strong></th>
        <th width="15%" ><strong>MONTO</strong></th>
        <th width="15%" ><strong>REGISTRO</strong></th>
    </tr>
    <?php
    $i=1;
    ?>

    @foreach($compra->pagos as $row)
        <tr >
            <td>{{$i++}}</td>
            <td>
                {{($row->fecha)}}
            </td>
            <td>
                {{\App\Tool::convertMoney($row->abono)}}
            </td>
            <td>
                {{$row->usuario->nombre}}
            </td>

        </tr>
    @endforeach

</table>
<table>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>TOTAL PAGADO</td>
        <td>{{\App\Tool::convertMoney($compra->totalCosto() - $compra->getTotalDeuda())}}</td>
    </tr>
    <tr>
        <td>SALDO</td>
        <td>{{\App\Tool::convertMoney($compra->getTotalDeuda())}}</td>
    </tr>


</table>



