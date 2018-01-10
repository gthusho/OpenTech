<tr>
    <th width="10%"><strong>#</strong></th>
    <th width="11%" ><strong>QUIEN VISITO</strong></th>
    <th width="20%"><strong>FECHA</strong></th>
    <th width="20%"><strong>UBICACION</strong></th>
    <th width="13%"><strong>MEDIDOS</strong></th>
    <th width="11%"><strong>PRODUCIDOS</strong></th>
    <th width="15%"><strong>GENERAL</strong></th>
</tr>
<?php
$i=1;
?>
@foreach($historial->visita as $fila)
    <tr>
        <td style="border-bottom: 1px dashed black;" align="center">{{$i++}}</td>
        <td style="border-bottom: 1px dashed black;" align="center">{{$fila->usuario->nombre}}</td>
        <td style="border-bottom: 1px dashed black;" align="center">{{date('d/m/Y',strtotime($fila->fecha))}}</td>
        <td style="border-bottom: 1px dashed black;" align="center">
            {{$fila->direccion}}
            @if($fila->barrio != null || $fila->barrio != '')
                <br><b class="text-primary">BARRIO: </b>{{$fila->barrio}}
            @endif
            @if($fila->zona != null || $fila->zona != '')
                <br><b class="text-primary">ZONA:</b> {{$fila->zona}}
            @endif
        </td>
        <td style="border-bottom: 1px dashed black;" align="rigth">{{$fila->cantMedidos()}}</td>
        <td style="border-bottom: 1px dashed black;" align="rigth">{{$fila->cantProducidos()}}</td>
        <td style="border-bottom: 1px dashed black;" align="rigth">{{$fila->cantMedidos() + $fila->cantProducidos()}}</td>
    </tr>
@endforeach
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="right" ><strong>TOTAL:</strong></td>
    <td align="right" >{{$historial->cantMed()}}</td>
    <td align="right">{{$historial->cantPrd()}}</td>
    <td align="right">{{$historial->cantMed() + $historial->cantPrd()}}</td>
</tr>