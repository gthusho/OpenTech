
    <table  cellspacing="5"  >
        <tr>
            <th width="6%" ><strong>#</strong></th>
            <th width="26%" ><strong>PRODUCTO</strong></th>
            <th width="21%" ><strong>MATERIAL</strong></th>
            <th width="15%"><strong>TALLA</strong></th>
            <th width="16%"><strong>PRECIO</strong></th>
            <th width="16%"><strong>COSTO</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($detalles as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->prodbase->descripcion)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->material->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->talla->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->precio)}}</td>
                <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->costo)}}</td>
            </tr>
        @endforeach
    </table>
