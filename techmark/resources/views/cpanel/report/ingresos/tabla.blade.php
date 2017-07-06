
    <table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="9%" ><strong>COMPRA</strong></th>
            <th width="10%" ><strong>FECHA</strong></th>
            <th width="10%"><strong>ARTICULO</strong></th>
            <th width="10%"><strong>CATEGORIA</strong></th>
            <th width="10%"><strong>MARCA</strong></th>
            <th width="10%"><strong>MATERIAL</strong></th>
            <th width="9%"><strong>CANTIDAD</strong></th>
            <th width="9%"><strong>UNIDAD</strong></th>
            <th width="9%"><strong>SUCURSAL</strong></th>
            <th width="9%"><strong>ALMACEN</strong></th>
        </tr>
        <?php
        $i=1;
        ?>
        @foreach($ingresos as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->id)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->compra->fecha)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->categoria->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->marca->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->material->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->medida->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->cantidad}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->sucursal->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->almacen->nombre)}}</td>

            </tr>
        @endforeach

    </table>
