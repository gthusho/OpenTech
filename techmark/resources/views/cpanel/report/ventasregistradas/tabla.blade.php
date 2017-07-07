
    <table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="9%" ><strong>TIPO PAGO</strong></th>
            <th width="10%" ><strong>CODIGO</strong></th>
            <th width="9%" ><strong>FECHA</strong></th>
            <th width="5%" ><strong>SUCURSAL</strong></th>
            <th width="5%"><strong>ALMACEN</strong></th>
            <th width="5%"><strong>CLIENTE</strong></th
            <th width="9%" ><strong>CANTIDAD ARTICULOS</strong></th>
            <th width="5%" ><strong>PRECIO TOTAL</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($ventas as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->tipo_pago}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->id)}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->fecha}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->sucursal->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->almacen->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->cliente->razon_social)}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->totalCantidad()}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->totalPrecio()}}</td>
            </tr>
        @endforeach

    </table>