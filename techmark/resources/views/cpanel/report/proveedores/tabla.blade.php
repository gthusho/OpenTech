
    <table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="20%" ><strong>PROVEEDOR</strong></th>
            <th width="10%" ><strong>NIT</strong></th>
            <th width="10%"><strong>TELEFONO</strong></th>
            <th width="10%"><strong>CELULAR</strong></th>
            <th width="15%"><strong>EMAIL</strong></th>
            <th width="10%"><strong>FAX</strong></th>
            <th width="15%"><strong>DIRECCION</strong></th>
            <th width="20%"><strong>REGISTRO</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($proveedores as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->razon_social}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->nit}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->telefono}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->celular}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->email}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->fax}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->direccion}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->registro}}</td>
            </tr>
        @endforeach
    </table>
