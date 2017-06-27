
    <table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="28%" ><strong>NOMBRE ALMACEN</strong></th>
            <th width="30%" ><strong>DIRECCION</strong></th>
            <th width="18%"><strong>CIUDAD</strong></th>
            <th width="20%"><strong>REGISTRO</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($almacenes as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->nombre}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->direccion}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->ciudad->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->registro}}</td>
</tr>
@endforeach
</table>
