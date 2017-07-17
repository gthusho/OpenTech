
    <table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="10%" ><strong>CODIGO</strong></th>
            <th width="15%" ><strong>FECHA</strong></th>
            <th width="15%"><strong>SUCURSAL</strong></th>
            <th width="20%"><strong>DESCRIPCION</strong></th>
            <th width="15%"><strong>A CARGO</strong></th>
            <th width="10%"><strong>CANTIDAD</strong></th>
            <th width="10%"><strong>PRECIO TOTAL</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($producciones as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->getCode())}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->fecha)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->sucursal->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->destino}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->trabajador->nombre}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->totalCantidad()}}</td>
                <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->totalPrecio())}}</td>
            </tr>
        @endforeach
    </table>