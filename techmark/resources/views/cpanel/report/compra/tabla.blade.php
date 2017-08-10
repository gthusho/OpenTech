<table width="60%">
    <tr>
        <td ><strong>FECHA</strong></td>
        <td >{{$compra->fecha}}</td>
    </tr>

    <tr>
        <td ><strong>CODIGO</strong></td>
        <td >{{$compra->getCode()}}</td>
    </tr>
    <tr>
        <td><strong>SUCURSAL:</strong></td>
        <td>{{$compra->sucursal->nombre}}</td>
    </tr>
    <tr>
        <td><strong>TIPO DE COMPRA:</strong></td>
        <td>{{$compra->tipo_compra}}</td>
    </tr>
    <tr>
        <td><strong>PROVEEDOR:</strong></td>
        <td>{{$compra->proveedor->razon_social}}</td>

    </tr>
    <tr>
        <td><strong>FACTURA:</strong></td>
        <td>{{$compra->nfactura}}</td>
    </tr>
    <tr>
        <td><strong>CANTIDAD:</strong></td>
        <td>{{ucwords($compra->totalCantidad())}}</td>
    </tr>
    <tr>
        <td><strong>TOTAL PRECIO</strong></td>
        <td>{{\App\Tool::convertMoney($compra->totalCosto())}}</td>
    </tr>

</table>
<br>
<table  cellspacing="5">
    <tr>
        <th width="3%" ><strong>#</strong></th>
        <th width="15%" ><strong>ARTICULOS</strong></th>
        <th width="15%" ><strong>CATEGORIA</strong></th>
        <th width="15%" ><strong>MARCA</strong></th>
        <th width="15%" ><strong>MATERIAL</strong></th>
        <th width="12%" ><strong>CANTIDAD</strong></th>
        <th width="10%" ><strong>UNIDAD</strong></th>
        <th width="15%" ><strong>COSTO</strong></th>
    </tr>
    <?php
    $i=1;
    ?>
    @foreach($compra->articulos as $row)
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
                {{\App\Tool::convertMoney($row->costo)}}
            </td>
            
        </tr>
    @endforeach
</table>
    <table align="right">

        <tr>
            <td ><strong>TOTAL COMPRA:</strong></td>
            <td>{{\App\Tool::convertMoney($compra->totalCosto())}}</td>
        </tr>
    </table>
<table width="40%">
    <tr>
        <td align="center">{{$compra->sucursal->nombre}}- {{$compra->sucursal->ciudad->nombre}}</td>
    </tr>
    <tr>
        <td align="center">Tel: {{$compra->sucursal->telefono}} - Dir: {{$compra->sucursal->direccion}}</td>
    </tr>
    <tr >
        <td align="center"> <b>Gracias por su Preferencia!!</b></td>
    </tr>
</table>