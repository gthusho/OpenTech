<tr>
    <th width="8%"><strong>#</strong></th>
    <th width="10%" ><strong>CODIGO</strong></th>
    <th width="10%" ><strong>ESTADO</strong></th>
    <th width="17%"><strong>SUCURSAL</strong></th>
    <th width="15%"><strong>ATENDIDO POR</strong></th>
    <th width="17%"><strong>TIEMPO</strong></th>
    <th width="8%"><strong>CANTIDAD</strong></th>
    <th width="15%"><strong>PRECIO TOTAL</strong></th>
</tr>
<?php
$i=1;
?>
@foreach($historial->produccion as $fila)
    <?php
    if($fila->estado=='c')
        $a='#808080';
    else
        $a='#0b0b0b';
    ?>
    <tr>
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="center">{{$i++}}</td>
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="center">{{$fila->getCode()}}</td>
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="center">
            @if($fila->checkState()[1]=='p'&& $fila->terminado==0)En Produccion
            @elseif($fila->checkState()[1]=='t' && $fila->terminado==1) Entregado
            @elseif($fila->checkState()[1]=='c')Cancelada
            @elseif($fila->checkState()[1]=='e')Terminada
            @endif
        </td>
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="center">{{$fila->sucursal->nombre}}</td>
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="center">{{$fila->usuario->nombre}}</td>
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="center">
            @if($fila->checkState()[1]=='t' && $fila->terminado==1)
                {{date('d/m/Y',strtotime($fila->fecha_entrega))}}
            @else
                {{date('d/m/Y',strtotime($fila->inicio))}} - {{date('d/m/Y',strtotime($fila->fin))}}
            @endif
        </td>
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="rigth">{{$fila->totalCantidad()}}</td>
        <td style="border-bottom: 1px dashed black; color: {{$a}}" align="rigth">{{\App\Tool::convertMoney($fila->precio)}}</td>
    </tr>
@endforeach
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right" ><strong>TOTAL:</strong></td>
    <td align="right">{{$historial->cantProd()}}</td>
    <td align="right">{{\App\Tool::convertMoney($historial->totProd())}}</td>
</tr>