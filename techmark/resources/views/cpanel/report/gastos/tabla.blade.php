
    <table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="15%"><strong>FECHA</strong></th>
            <th width="17%" ><strong>USUARIO</strong></th>
            <th width="20%" ><strong>SUCURSAL</strong></th>
            <th width="30%"><strong>DESCRIPCION</strong></th>
            <th width="15%"><strong>MONTO</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($gastos as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{date('d/m/Y',strtotime($row->fecha))}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->usuario->nombre}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->sucursal->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->descripcion)}}</td>
                <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->monto)}}</td>


            </tr>
        @endforeach

    </table>


