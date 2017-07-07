<table>
    <tr>
        <td>FECHA</td>
        <td>{{$venta->registro}}</td>
    </tr>
    <tr>
        <td>COMPRA</td>
        <td>{{$venta->getCode()}}</td>
    </tr>
    <tr>
        <td>CLIENTE</td>
        <td>{{$venta->cliente->razon_social}}</td>

    </tr>
    <tr>
        <td>NIT</td>
        <td>{{$venta->cliente->nit}}</td>
    </tr>

    <tr>
        <td>SUCURSAL</td>
        <td>{{$venta->sucursal->nombre}}</td>
    </tr>

    <tr>
        <td>CANTIDAD</td>
        <td>{{ucwords($venta->totalCantidad())}}</td>
    </tr>
    <tr>
        <td>TOTAL PRECIO</td>
        <td>{{\App\Tool::convertMoney($venta->totalPrecio())}}</td>
    </tr>
    <tr>
        <td>OBSERVACIONES</td>
        <td>{{$venta->observaciones}}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
</table>



<table  cellspacing="5">
    <tr>
        <th width="5%" ><strong>#</strong></th>
        <th width="15%" ><strong>ARTICULOS</strong></th>
        <th width="15%" ><strong>CATEGORIA</strong></th>
        <th width="15%" ><strong>MARCA</strong></th>
        <th width="15%" ><strong>MATERIAL</strong></th>
        <th width="10%" ><strong>CANTIDAD</strong></th>
        <th width="10%" ><strong>UNIDAD</strong></th>
        <th width="15%" ><strong>PRECIO</strong></th>

    </tr>
    <?php
    $i=1;
    ?>

    @foreach($venta->detallecotizacion as $row)
        <tr >
            <td>{{$i++}}</td>
            <td>
                {{$row->articulo->nombre}}

            </td>
            <td>
                {{\App\ToolArticuloCart::getNombreById($row->articulo->categoria_articulo_id,'categoria')}}
            </td>
            <td>
                {{\App\ToolArticuloCart::getNombreById($row->articulo->marca_id,"marca")}}
            </td>
            <td> {{\App\ToolArticuloCart::getNombreById($row->articulo->material_id,"material")}}</td>
            <td>{{number_format((float)$row->cantidad, 2, '.', '')}}</td>
            <td>{{\App\ToolArticuloCart::getNombreById($row->articulo->unidad_id,"unidad")}}</td>
            <td>
                {{\App\Tool::convertMoney($row->articulo->getPrecio($row->dp))}}
            </td>

        </tr>
    @endforeach

</table>
