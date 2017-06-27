
    <table  cellspacing="5"  >
        <tr>
            <th width="3%" ><strong>#</strong></th>
            <th width="20%" ><strong>NOMBRE</strong></th>
            <th width="8%" ><strong>CI</strong></th>
            <th width="12%"><strong>DIRECCION</strong></th>
            <th width="8%"><strong>TELEFONO</strong></th>
            <th width="10%"><strong>EMAIL</strong></th>
            <th width="12%"><strong>SUCURSAL</strong></th>
            <th width="10%"><strong>CARGO</strong></th>
            <th width="8%"><strong>SUELDO</strong></th>
            <th width="10%"><strong>FECHA DE INGRESO</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($trabajadores as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->nombre}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->ci}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->direccion}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->telefono}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->email}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->sucursal->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->cargo}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->sueldo}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->fecha_ingreso}}</td>

            </tr>
        @endforeach
    </table>
