
    <table  cellspacing="5"  >
        <tr>
            <th width="3%" ><strong>#</strong></th>
            <th width="8%" ><strong>VENTA</strong></th>
            <th width="8%" ><strong>FECHA</strong></th>
            <th width="10%"><strong>ARTICULO</strong></th>
            <th width="12%"><strong>CATEGORIA</strong></th>
            <th width="10%"><strong>MARCA</strong></th>
            <th width="10%"><strong>MATERIAL</strong></th>
            <th width="12%"><strong>CANTIDAD</strong></th>
            <th width="10%"><strong>UNIDAD</strong></th>
            <th width="10%"><strong>SUCURSAL</strong></th>
            <th width="10%"><strong>ALMACEN</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($egresos as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->ventaarticulo->getCode())}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->registro}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->categoria->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->marca->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->material->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->cantidad}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->medida->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->sucursal->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->almacen->nombre)}}</td>

            </tr>
        @endforeach

    </table>


