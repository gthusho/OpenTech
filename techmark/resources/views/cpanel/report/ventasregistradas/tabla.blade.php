<table  cellspacing="5"  >
        <tr>
            <th width="3%" ><strong>#</strong></th>
            <th width="10%" ><strong>TIPO PAGO</strong></th>
            <th width="10%" ><strong>CODIGO</strong></th>
            <th width="15%" ><strong>FECHA</strong></th>
            <th width="15%" ><strong>SUCURSAL</strong></th>
            <th width="15%"><strong>ALMACEN</strong></th>
            <th width="20%"><strong>CLIENTE</strong></th>
            <th width="12%" ><strong>PRECIO TOTAL</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($ventas as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">@if($row->estado=='c')<b>Anulado</b>@else{{$row->tipo_pago}}@endif</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->getcode())}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->registro}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->sucursal->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->almacen->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->cliente->razon_social)}}</td>
                <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->totalPrecio())}}</td>
            </tr>
        @endforeach

    </table>