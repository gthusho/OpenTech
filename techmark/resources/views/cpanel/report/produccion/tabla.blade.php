<h3>
    <table>
        <br>
        <tr>
            <td width="20%">FECHA</td>
            <td width="35%">{{$produccion->fecha}}</td>
        </tr>

        <tr>
            <td width="20%">CODIGO</td>
            <td width="20%">{{$produccion->getCode()}}</td>
        </tr>
    </table>
</h3>

<br>

<table width="80%">
    <tr>
        <td><strong>SUCURSAL:</strong></td>
        <td>{{$produccion->sucursal->nombre}}</td>
    </tr>
    <tr>
        <td><strong>A CARGO:</strong></td>
        <td>{{$produccion->trabajador->nombre}}</td>
    </tr>
    <tr>
        <td><strong>FECHA DE INICIO PRODUCCION:</strong></td>
        <td>{{$produccion->inicio}}</td>

    </tr>
    <tr>
        <td><strong>FECHA FIN DE PRODUCCION:</strong></td>
        <td>{{$produccion->fin}}</td>
    </tr>
    <tr>
        <td><strong>CANTIDAD:</strong></td>
        <td>{{ucwords($produccion->totalCantidad())}}</td>
    </tr>
    <tr>
        <td><strong>TOTAL PRECIO</strong></td>
        <td>{{\App\Tool::convertMoney($produccion->totalPrecio())}}</td>
    </tr>
    <tr>
        <td><strong>DESTINO A:</strong></td>
        <td>{{$produccion->destino}}</td>
    </tr>
</table>
<P></P>
<table  cellspacing="5">
    <tr>
        <th width="3%" ><strong>#</strong></th>
        <th width="15%" ><strong>ARTICULOS</strong></th>
        <th width="15%" ><strong>CATEGORIA</strong></th>
        <th width="12%" ><strong>MARCA</strong></th>
        <th width="12%" ><strong>MATERIAL</strong></th>
        <th width="12%" ><strong>CANTIDAD</strong></th>
        <th width="10%" ><strong>UNIDAD</strong></th>
        <th width="12%" ><strong>PRECIO UNITARIO</strong></th>
        <th width="12%" ><strong>TOTAL</strong></th>

    </tr>
    <?php
    $i=1;
    ?>

    @foreach($produccion->detalle as $row)
        <tr >
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->articulo->nombre}}</td>
            <td style="border-bottom: 1px dashed black;">
                {{\App\ToolArticuloCart::getNombreById($row->articulo->categoria_articulo_id,'categoria')}}
            </td>
            <td style="border-bottom: 1px dashed black;">
                {{\App\ToolArticuloCart::getNombreById($row->articulo->marca_id,"marca")}}
            </td>
            <td style="border-bottom: 1px dashed black;"> {{\App\ToolArticuloCart::getNombreById($row->articulo->material_id,"material")}}</td>
            <td style="border-bottom: 1px dashed black;">{{number_format((float)$row->cantidad, 2, '.', '')}}</td>
            <td style="border-bottom: 1px dashed black;">{{\App\ToolArticuloCart::getNombreById($row->articulo->unidad_id,"unidad")}}</td>
            <td style="border-bottom: 1px dashed black;">
                {{\App\Tool::convertMoney($row->articulo->getPrecio($row->dp))}}
            </td>
            <td style="border-bottom: 1px dashed black;">
                {{\App\Tool::convertMoney($row->precio)}}
            </td>
        </tr>
    @endforeach

</table>

<h3>
    <table align="right">

        <tr>
            <td ><strong>TOTAL COMPRA:</strong></td>
            <td>{{\App\Tool::convertMoney($produccion->totalPrecio())}}</td>
        </tr>


    </table>
</h3>
