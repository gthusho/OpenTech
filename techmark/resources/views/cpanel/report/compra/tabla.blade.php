<table>
    <tr>
        <td>FECHA</td>
        <td>{{$compra->fecha}}</td>
    </tr>
    <tr>
        <td>COMPRA</td>
        <td>{{$compra->getCode()}}</td>
    </tr>
    <tr>
        <td>SUCURSAL</td>
        <td>{{$compra->sucursal->nombre}}</td>
    </tr>
    <tr>
        <td>TIPO DE COMPRA</td>
        <td>{{$compra->tipo_compra}}</td>
    </tr>
    <tr>
        <td>PROVEEDOR</td>
        <td>{{$compra->proveedor->razon_social}}</td>

    </tr>
    <tr>
        <td>FACTURA</td>
        <td>{{$compra->nfactura}}</td>
    </tr>
    <tr>
        <td>CANTIDAD</td>
        <td>{{ucwords($compra->totalCantidad())}}</td>
    </tr>
    <tr>
        <td>COSTOS</td>
        <td>{{\App\Tool::convertMoney($compra->totalCosto())}}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
</table>



<table  cellspacing="5">
    <tr>
        <th>#</th>
        <th>ARTICULO</th>
        <th>CATEGORIA</th>
        <th>MARCA</th>
        <th>MATERIAL</th>
        <th>CANTIDAD</th>
        <th>UNIDAD</th>
        <th>COSTO</th>
    </tr>
    <?php
    $i=1;
    ?>

    @foreach($compra->articulos as $row)
        <tr >
            <td>{{$i++}}</td>
            <td>{{$row->articulo->nombre}}</td>
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
                {{\App\Tool::convertMoney($row->costo)}}
            </td>
            
        </tr>
    @endforeach

</table>
