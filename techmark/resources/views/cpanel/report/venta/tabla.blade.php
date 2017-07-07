
    <table  cellspacing="5"  >
        <tr>
            <th width="5%" ><strong>#</strong></th>
            <th width="10%" ><strong>ARTICULO</strong></th>
            <th width="10%"><strong>CATEGORIA</strong></th>
            <th width="10%"><strong>MARCA</strong></th>
            <th width="10%"><strong>MATERIAL</strong></th>
            <th width="10%"><strong>CANTIDAD</strong></th>
            <th width="9%"><strong>UNIDAD</strong></th>
            <th width="9%"><strong>PRECIO</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($ventas as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->nombre)}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->categoria_articulo_id,'categoria')}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->marca_id,"marca")}}</td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->articulo->material_id,"material")}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->articulo->unidad_id,"unidad"}}</td>
                <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->precio)}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->id}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->id}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->sucursal->nombre}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->almacen->nombre}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->registro}}</td>
            </tr>
        @endforeach
    </table>


