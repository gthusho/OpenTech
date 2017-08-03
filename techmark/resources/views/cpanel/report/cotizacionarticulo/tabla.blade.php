<h3>
    <br>
    <table>
        <br>
        <tr>
            <td width="20%">FECHA</td>
            <td width="35%">{{date('d/m/Y',strtotime($venta->registro))}}</td>
        </tr>

        <tr>
            <td width="20%">CODIGO</td>
            <td width="20%">{{$venta->getCode()}}</td>
        </tr>
        <tr>
            <td width="20%">VALIDO HASTA</td>
            <td width="35%">{{date('d/m/Y',strtotime($venta->fvalides))}}</td>
        </tr>
    </table>
</h3>

<br>

<table width="40%" style="line-height:20pt;">
    <tr>
        <td><strong>CLIENTE:</strong></td>
        <td>{{$venta->cliente->razon_social}}</td>

    </tr>
    <tr>
        <td><strong>NIT:</strong></td>
        <td>{{$venta->cliente->nit}}</td>
    </tr>

    <tr>
        <td><strong>SUCURSAL:</strong></td>
        <td>{{$venta->sucursal->nombre}}</td>
    </tr>
    <tr>
        <td><strong>CANTIDAD:</strong></td>
        <td>{{ucwords($venta->totalCantidad())}}</td>
    </tr>
    <tr>
        <td><strong>TOTAL PRECIO</strong></td>
        <td>{{\App\Tool::convertMoney($venta->totalPrecio())}}</td>
    </tr>

</table>

<P></P>

<table  cellspacing="5">
    <tr>
        <th width="3%" ><strong>#</strong></th>
        <th width="15%" ><strong>ARTICULOS</strong></th>
        <th width="15%" ><strong>CATEGORIA</strong></th>
        <th width="15%" ><strong>MARCA</strong></th>
        <th width="15%" ><strong>MATERIAL</strong></th>
        <th width="12%" ><strong>CANTIDAD</strong></th>
        <th width="10%" ><strong>UNIDAD</strong></th>
        <th width="15%" ><strong>PRECIO</strong></th>

    </tr>
    <?php
    $i=1;
    ?>
    @foreach($venta->detallecotizacion as $row)
        <tr >
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">
                {{$row->articulo->nombre}}

            </td>
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

        </tr>
    @endforeach

</table>

<h3>
    <table align="right">

        <tr>
            <td ><strong>TOTAL PRECIO:</strong></td>
            <td>{{\App\Tool::convertMoney($venta->totalPrecio())}}</td>
        </tr>


    </table>
</h3>