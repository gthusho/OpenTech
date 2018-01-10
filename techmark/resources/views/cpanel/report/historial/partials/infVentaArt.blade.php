<tr>
    <th width="8%"><strong>#</strong></th>
    <th width="10%" ><strong>CODIGO</strong></th>
    <th width="12%" ><strong>TIPO</strong></th>
    <th width="20%"><strong>SUCURSAL</strong></th>
    <th width="15%"><strong>ATENDIDO POR</strong></th>
    <th width="12%"><strong>FECHA</strong></th>
    <th width="8%"><strong>CANTIDAD</strong></th>
    <th width="15%"><strong>PRECIO TOTAL</strong></th>
</tr>
<?php
$i=1;
?>
@foreach($historial->ventaarticulo as $fila)
    <?php
            if($fila->estado=='c')
                $a='#808080';
            else
                $a='#0b0b0b';
    ?>
    <tr>
        <td style="border-bottom: 1px dashed black; : {{$a}}" align="center">{{$i++}}</td>
        <td style="border-bottom: 1px dashed black; color: {{$a}};" align="center">{{$fila->getCode()}}</td>
        @if($fila->estado=='c')
            <td style="border-bottom: 1px dashed black; color: {{$a}}" align="center">Anulado</td>
        @else
            <td style="border-bottom: 1px dashed black;" align="center">{{$fila->tipo_pago}}</td>
        @endif
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="center" >{{$fila->sucursal->nombre}}</td>
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="center">{{$fila->usuario->nombre}}</td>
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="center">{{date('d/m/Y H:m',strtotime($fila->registro))}}</td>
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="rigth">{{$fila->totalCantidad()}}</td>
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="rigth">{{\App\Tool::convertMoney($fila->totalPrecio())}}</td>
    </tr>
@endforeach
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right" ><strong>TOTAL:</strong></td>
    <td align="right">{{$historial->cantVenArt()}}</td>
    <td align="right">{{\App\Tool::convertMoney($historial->totVenArt())}}</td>
</tr>