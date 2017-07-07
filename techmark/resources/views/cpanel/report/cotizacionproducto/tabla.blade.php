<table>
    <tr>
        <td>FECHA</td>
        <td>{{$cotizacion->registro}}</td>
    </tr>
    <tr>
        <td>COMPRA</td>
        <td>{{$cotizacion->getCode()}}</td>
    </tr>
    <tr>
        <td>CLIENTE</td>
        <td>{{$cotizacion->cliente->razon_social}}</td>

    </tr>
    <tr>
        <td>NIT</td>
        <td>{{$cotizacion->cliente->nit}}</td>
    </tr>

    <tr>
        <td>SUCURSAL</td>
        <td>{{$cotizacion->sucursal->nombre}}</td>
    </tr>

    <tr>
        <td>CANTIDAD</td>
        <td>{{ucwords($cotizacion->totalCantidad())}}</td>
    </tr>
    <tr>
        <td>TOTAL PRECIO</td>
        <td>{{\App\Tool::convertMoney($cotizacion->totalPrecio())}}</td>
    </tr>
    <tr>
        <td>OBSERVACIONES</td>
        <td>{{$cotizacion->observaciones}}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
</table>



<table  cellspacing="5">
    <tr>
        <th width="5%" ><strong>#</strong></th>
        <th width="15%" ><strong>PRODUCTO</strong></th>
        <th width="15%" ><strong>DESCRIPCION</strong></th>
        <th width="15%" ><strong>TALLA</strong></th>
        <th width="15%" ><strong>MATERIAL</strong></th>
        <th width="10%" ><strong>CANTIDAD</strong></th>
        <th width="10%" ><strong>PRECIO</strong></th>

    </tr>
    <?php
    $i=1;
    ?>

    @foreach($cotizacion->detalle as $row)
        <tr >
            <td>{{$i++}}</td>
            <td>
                {{$row->productobase->descripcion}}

            </td>
            <td>
                {{$row->descripcion}}
            </td>
            <td>
                {{$row->talla->nombre}}
            </td>
            <td> {{$row->material->nombre}}</td>
            <td>{{number_format((float)$row->cantidad, 2, '.', '')}}</td>
            <td>
                {{\App\Tool::convertMoney($row->precio)}}
            </td>

        </tr>
    @endforeach

</table>

