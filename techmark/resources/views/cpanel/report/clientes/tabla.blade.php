<table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="20%" ><strong>NOMBRE COMPLETO</strong></th>
            <th width="15%" ><strong>NIT</strong></th>
            <th width="15%"><strong>TELEFONO</strong></th>
            <th width="20%"><strong>DIRECCION</strong></th>
            <th width="20%"><strong>EMAIL</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($clientes as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->razon_social}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->nit}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->telefono}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->direccion}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->email}}</td>
            </tr>
        @endforeach
    </table>
