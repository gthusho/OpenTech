<br>
<table width="80%" >
    <tr>
        <td ><strong>CODIGO</strong></td>
        <td >{{$produccion->getCode()}}</td>
    </tr>
    <tr> <td><strong>ESTADO PRODUCCION:</strong></td>
        <td>
            @if($produccion->checkState()[1]=='p')<B>En Produccion </B>
            @elseif($produccion->checkState()[1]=='t' && $produccion->terminado==1) <b>Entregado</b>
            @elseif($produccion->checkState()[1]=='e' && $produccion->terminado==0)<b>Plazo Terminado</b>
            @endif
        </td>
    </tr>
    <tr>
        <td><strong>SUCURSAL:</strong></td>
        <td>{{$produccion->sucursal->nombre}}</td>
    </tr>
    <tr>
        <td><strong>A CARGO:</strong></td>
        <td>{{$produccion->trabajador->nombre}}</td>
    </tr>
    <tr>
        <td><strong>CLIENTE:</strong></td>
        <td>{{$produccion->cliente->razon_social}}</td>
    </tr>
    <?php
    $fechas=explode('-',$produccion->fecha);
    $inicio=$fechas[0];
    $fin=$fechas[1];
            ?>
    <tr>
        <td><strong>FECHA DE INICIO PRODUCCION:</strong></td>
        <td>{{date('d/m/Y',strtotime($inicio))}}</td>

    </tr>
    <tr>
        <td><strong>FECHA FIN DE PRODUCCION:</strong></td>
        <td>{{date('d/m/Y',strtotime($fin))}}</td>
    </tr>
    <tr>
        <td><strong>TOTAL COSTO PRODUCCION</strong></td>
        <td>{{\App\Tool::convertMoney($produccion->totalPrecio())}}</td>
    </tr>
    <tr>
        <td><strong>TOTAL PRECIO CONFECCION</strong></td>
        <td>{{\App\Tool::convertMoney($produccion->precio)}}</td>
    </tr>
    <tr>
        <td><strong>PAGO EFECTIVO</strong></td>
        <td>{{\App\Tool::convertMoney($produccion->adelanto)}}</td>
    </tr>
    <tr>
        <td><strong>SALDO</strong></td>
        <td>{{\App\Tool::convertMoney(($produccion->precio - $produccion->adelanto))}}</td>
    </tr>

    <tr>
        <td COLSPAN="2"><strong>DESCRIPCION DE LA PRODUCCION:</strong></td>

    </tr>
    <tr>
        <td COLSPAN="2">{{$produccion->destino}}</td>
    </tr>
</table>
<br>
<br>
<table >
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
    <br>
</table>

    <table align="right">

        <tr>
            <td ><strong>COSTO PRODUCCION:</strong></td>
            <td>{{\App\Tool::convertMoney($produccion->totalPrecio())}}</td>
        </tr>


    </table>

<br><br><br>
<table width="40%">
    <tr>
        <td align="center">{{$produccion->sucursal->nombre}}- {{$produccion->sucursal->ciudad->nombre}}</td>
    </tr>
    <tr>
        <td align="center">Tel: {{$produccion->sucursal->telefono}} - Dir: {{$produccion->sucursal->direccion}}</td>
    </tr>
    <tr >
        <td align="center"> <b>Gracias por su Preferencia!!</b></td>
    </tr>
</table>