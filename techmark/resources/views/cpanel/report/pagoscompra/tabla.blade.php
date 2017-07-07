
    <table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="15%" ><strong>FECHA</strong></th>
            <th width="15%" ><strong>MONTO</strong></th>
            <th width="15%"><strong>REGISTRO</strong></th>

        </tr>
        <?php
        $i=1;
        ?>

        @foreach($compras as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->fecha)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->abono)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->usuario->nombre)}}</td>
            </tr>
        @endforeach
    </table>