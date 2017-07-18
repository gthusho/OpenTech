<table cellspacing="5">
    <tr>
        <th width="3%" ><strong>#</strong></th>
        <th width="15%"><strong>SUCURSAL</strong></th>
        <th width="20%"><strong>NOMBRE ARTICULO</strong></th>
        <th width="8%"><strong>CODIGO</strong></th>
        <th width="15%"><strong>CATEGORIA</strong></th>
        <th width="11%"><strong>MARCA</strong></th>
        <th width="11%"><strong>MATERIAL</strong></th>
        <th width="8%"><strong>STOCK</strong></th>
        <th width="9%"><strong>UNIDAD</strong></th>
    </tr>
    <?php
    $i=1;
    ?>
    @foreach($articulos as $row)
        <tr>
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->sucursal->nombre}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->articulo->nombre}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->articulo->codigo}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->articulo->categoria->nombre}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->articulo->marca->nombre}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->articulo->material->nombre}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->cantidad}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->articulo->medida->nombre}}</td>
        </tr>
    @endforeach
</table>
