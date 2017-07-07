<table  cellspacing="5"  >
    <tr>
        <th width="20%" ><strong>FECHA COMPRA</strong></th>
    </tr>
    <tr>
        <th width="45%" ><strong>PROVEEDOR</strong></th>
        <th width="30%" ><strong>FACTURA</strong></th>
    </tr>
    <tr>
        <th width="25%" ><strong>SUCURSAL</strong></th>
        <th width="25%" ><strong>TIPO DE COMPRA</strong></th>
        <th width="30%"><strong>CANTIDAD ARTICULOS</strong></th>
        <th width="25%"><strong>TOTAL COSTOS</strong></th>
    </tr>
    <?php
    $i=1;
    ?>

    @foreach($compras as $row)
        <tr >
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->id)}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->id)}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->id)}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->id}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->id}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->id}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->id}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->sucursal->nombre}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->almacen->nombre}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->registro}}</td>
        </tr>
    @endforeach

</table>

<table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="17%" ><strong>ARTICULO</strong></th>
            <th width="20%"><strong>CATEGORIA</strong></th>
            <th width="15%"><strong>MARCA</strong></th>
            <th width="15%"><strong>MATERIAL</strong></th>
            <th width="15%"><strong>CANTIDAD</strong></th>
            <th width="10%"><strong>UNIDAD</strong></th>
            <th width="10%"><strong>COSTO</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($compras as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->categoria_articulo_id,'categoria')}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->marca_id,"marca")}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->material_id,"material")}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->cantidad}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->unidad_id,"unidad")}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->costo}}</td>

            </tr>
        @endforeach

    </table>
