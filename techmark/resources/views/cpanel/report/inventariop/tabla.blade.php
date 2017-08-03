<table cellspacing="5">
    <tr>
        <th width="3%" ><strong>#</strong></th>
        <th width="22%"><strong>SUCURSAL</strong></th>
        <th width="42%"><strong>NOMBRE PRODUCTO</strong></th>
        <th width="13%"><strong>CODIGO</strong></th>
        <th width="15%"><strong>TALLAS</strong></th>
        <th width="8%"><strong>STOCK</strong></th>
    </tr>
    <?php
    $i=1;
    ?>
    @foreach($productos as $row)
        <tr>
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->sucursal->nombre}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->producto->descripcion}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->producto->codigo}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->talla->nombre}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->cantidad}}</td>
        </tr>
    @endforeach
</table>
