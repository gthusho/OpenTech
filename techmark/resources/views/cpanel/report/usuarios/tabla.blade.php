
    <table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="10%" ><strong>USUARIO</strong></th>
            <th width="10%" ><strong>ROL</strong></th>
            <th width="25%"><strong>NOMBRE COMPLETO</strong></th>
            <th width="15%"><strong>TELEFONO</strong></th>
            <th width="15%"><strong>CELULAR</strong></th>
            <th width="20%"><strong>DIRECCION</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($usuarios as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->username)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->rol->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->telefono}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->celular}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->direccion}}</td>
            </tr>
        @endforeach
    </table>
