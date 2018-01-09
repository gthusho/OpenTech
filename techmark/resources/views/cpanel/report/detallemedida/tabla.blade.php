<br>
<br>
<table width="60%">
    <tr>
        <td ><strong>CLIENTE:</strong></td>
        <td >{{$visita->cliente->razon_social}}</td>
    </tr>
    <tr>
        <td ><strong>FECHA:</strong></td>
        <td >{{date('d/m/Y',strtotime($visita->fecha)) .' '. $visita->hora}}</td>
    </tr>
    <tr>
        <td><strong>DIRECCION:</strong></td>
        <td>{{$visita->direccion}}</td>

    </tr>
    <tr>
        <td><strong>BARRIO:</strong></td>
        <td>{{$visita->barrio}}</td>
    </tr>

    <tr>
        <td><strong>ZONA:</strong></td>
        <td>{{$visita->zona}}</td>
    </tr>
    <tr>
        <td><strong>MEDICIONES EN ESPERA</strong></td>
        <td>{{$visita->cantMedidos()}}</td>
    </tr>

    <tr>
        <td><strong>MEDICIONES COTIZADAS</strong></td>
        <td>{{$visita->cantProducidos()}}</td>
    </tr>
    <tr>
        <td><strong>TOTAL MEDICIONES:</strong></td>
        <td>{{$visita->cantMedidos() + $visita->cantProducidos()}}</td>
    </tr>
</table>
<br>
<br>
<br>
<table cellpadding="5">
    <tr>
        <th width="5%">#</th>
        <th width="12%">ESTADO</th>
        <th width="27%">DESCRIPCION</th>
        <th width="20%">UBICACION</th>
        <th width="8%">CANT</th>
        <th width="28%">DIMENSIONES</th>
    </tr>
    <?php
    $i=1;
    ?>
    @foreach($visita->detalle as $fila)
        <tr>
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            @if($fila->estado==0)
                <td style="border-bottom: 1px dashed black;">En Espera</td>
            @else
                <td style="border-bottom: 1px dashed black;">Producido</td>
            @endif
            <td style="border-bottom: 1px dashed black;">{{$fila->descripcion}}</td>
            <td style="border-bottom: 1px dashed black;">{{$fila->ubicacion}}</td>
            <td style="border-bottom: 1px dashed black;">{{$fila->cantidad}}</td>
            <td style="border-bottom: 1px dashed black;">{{$fila->alto}} largo x {{$fila->ancho}} ancho</td>
        </tr>
    @endforeach
</table>