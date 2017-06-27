
    <table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="10%" ><strong>NOMBRE</strong></th>
            <th width="9%" ><strong>CODIGO</strong></th>
            <th width="10%"><strong>CATEGORIA</strong></th>
            <th width="10%"><strong>MARCA</strong></th>
            <th width="10%"><strong>MATERIAL</strong></th>
            <th width="10%"><strong>MEDIDA</strong></th>
            <th width="9%"><strong>COSTO</strong></th>
            <th width="9%"><strong>PRECIO #1</strong></th>
            <th width="9%"><strong>PRECIO #2</strong></th>
            <th width="9%"><strong>PRECIO #3</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($articulos as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->codigo)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->categoria->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->marca->nombre}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->material->nombre}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->medida->nombre}}</td>
                <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->costo)}}</td>
                <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->precio1)}}</td>
                <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->precio2)}}</td>
                <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->precio3)}}</td>
            </tr>
        @endforeach
    </table>
