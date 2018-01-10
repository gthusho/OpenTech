<tr>
    <th width="10%"><strong>#</strong></th>
    <th width="11%" ><strong>CODIGO</strong></th>
    <th width="20%"><strong>SUCURSAL</strong></th>
    <th width="20%"><strong>ATENDIDO POR</strong></th>
    <th width="13%"><strong>FECHA</strong></th>
    <th width="11%"><strong>CANTIDAD</strong></th>
    <th width="15%"><strong>PRECIO TOTAL</strong></th>
</tr>
<?php
$i=1;
?>
@foreach($historial->cotizacionproducto as $fila)
    <tr>
        <td style="border-bottom: 1px dashed black;" align="center">{{$i++}}</td>
        <td style="border-bottom: 1px dashed black;" align="center">{{$fila->getCode()}}</td>
        <td style="border-bottom: 1px dashed black;" align="center">{{$fila->sucursal->nombre}}</td>
        <td style="border-bottom: 1px dashed black;" align="center">{{$fila->usuario->nombre}}</td>
        <td style="border-bottom: 1px dashed black;" align="center">{{date('d/m/Y H:m',strtotime($fila->registro))}}</td>
        <td style="border-bottom: 1px dashed black;" align="rigth">{{$fila->totalCantidad()}}</td>
        <td style="border-bottom: 1px dashed black;" align="rigth">{{\App\Tool::convertMoney($fila->totalPrecio())}}</td>
    </tr>
@endforeach
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right" ><strong>TOTAL:</strong></td>
    <td align="right">{{$historial->cantCotPrd()}}</td>
    <td align="right">{{\App\Tool::convertMoney($historial->totCotPrd())}}</td>
</tr>