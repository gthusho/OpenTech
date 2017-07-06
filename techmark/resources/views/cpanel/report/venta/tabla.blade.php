
    <table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="9%" ><strong>COMPRA</strong></th>
            <th width="10%" ><strong>ARTICULO</strong></th>
            <th width="10%"><strong>CATEGORIA</strong></th>
            <th width="10%"><strong>MARCA</strong></th>
            <th width="10%"><strong>MATERIAL</strong></th>
            <th width="10%"><strong>CANTIDAD</strong></th>
            <th width="9%"><strong>UNIDAD</strong></th>
            <th width="9%"><strong>SUCURSAL</strong></th>
            <th width="9%"><strong>ALMACEN</strong></th>
            <th width="9%"><strong>REGISTRO</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($ventas as $row)
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
