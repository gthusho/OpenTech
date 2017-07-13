<h3>
    <br>
    <table>
        <br>
        <tr>
            <td width="20%">FECHA</td>
            <td width="35%">{{$cotizacion->registro}}</td>
        </tr>

        <tr>
            <td width="20%">CODIGO</td>
            <td width="20%">{{$cotizacion->getCode()}}</td>
        </tr>
    </table>
</h3>
<table width="40%">
    <tr>
        <td><strong>CLIENTE:</strong></td>
        <td>{{$cotizacion->cliente->razon_social}}</td>

    </tr>
    <tr>
        <td><strong>NIT:</strong></td>
        <td>{{$cotizacion->cliente->nit}}</td>
    </tr>

    <tr>
        <td><strong>SUCURSAL:</strong></td>
        <td>{{$cotizacion->sucursal->nombre}}</td>
    </tr>
    <tr>
        <td><strong>CANTIDAD:</strong></td>
        <td>{{ucwords($cotizacion->totalCantidad())}}</td>
    </tr>
    <tr>
        <td><strong>TOTAL PRECIO</strong></td>
        <td>{{\App\Tool::convertMoney($cotizacion->totalPrecio())}}</td>
    </tr>

</table>
<p></p>

<table  cellspacing="5">
    <tr>
        <th width="5%" ><strong>#</strong></th>
        <th width="20%" ><strong>PRODUCTO</strong></th>
        <th width="20%" ><strong>DESCRIPCION</strong></th>
        <th width="10%" ><strong>TALLA</strong></th>
        <th width="15%" ><strong>MATERIAL</strong></th>
        <th width="15%" ><strong>CANTIDAD</strong></th>
        <th width="12%" ><strong>PRECIO</strong></th>

    </tr>
    <?php
    $i=1;
    ?>

    @foreach($cotizacion->detalle as $row)
        <tr >
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">
                {{$row->productobase->descripcion}}

            </td>
            <td style="border-bottom: 1px dashed black;">
                {{$row->descripcion}}
            </td>
            <td style="border-bottom: 1px dashed black;">
                {{$row->talla->nombre}}
            </td>
            <td style="border-bottom: 1px dashed black;"> {{$row->material->nombre}}</td>
            <td style="border-bottom: 1px dashed black;">{{number_format((float)$row->cantidad, 2, '.', '')}}</td>
            <td style="border-bottom: 1px dashed black;">
                {{\App\Tool::convertMoney($row->precio)}}
            </td>

        </tr>
    @endforeach

</table>

