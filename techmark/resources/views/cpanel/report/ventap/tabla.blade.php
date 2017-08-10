<table width="60%">
    <tr>
        <td ><strong>FECHA</strong></td>
        <td >{{$venta->registro}}</td>
    </tr>

    <tr>
        <td ><strong>CODIGO</strong></td>
        <td >{{$venta->getCode()}}</td>
    </tr>
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
        <td><strong>TIPO DE VENTA:</strong></td>
        <td>@if($venta->estado=='c')<b>Anulado</b>@else{{$venta->tipo_pago}}@endif</td>
    </tr>

    <tr>
        <td><strong>TOTAL PRECIO</strong></td>
        <td>{{\App\Tool::convertMoney($venta->totalPrecio())}}</td>
    </tr>
    <tr>
        <td><strong>OBSERVACIONES:</strong></td>
        <td>{{$venta->observaciones}}</td>
    </tr>
</table>

<table  cellspacing="5">
    <tr>
        <th width="5%" ><strong>#</strong></th>
        <th width="28%" ><strong>PRODUCTO</strong></th>
        <th width="15%" ><strong>TALLA</strong></th>
        <th width="15%" ><strong>PRECIO U</strong></th>
        <th width="15%" ><strong>CANTIDAD</strong></th>
        <th width="18%" ><strong>TOTAL</strong></th>
    </tr>
    <?php
    $i=1;
    ?>
    @foreach($venta->detalleventas as $row)
        <tr >
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->producto->descripcion}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->talla->nombre}} </td>
            <td style="border-bottom: 1px dashed black;"><?php
                $punitario = 0;
                $pt =  \App\ProductoTalla::where('producto_id',$row->producto_id)->where('talla_id',$row->talla_id)->get()->first();
                if(\App\Tool::existe($pt)){
                    switch ($row->dp){
                        case 'P1':{
                            $punitario = $pt->precio1;
                            break;
                        }
                        case 'P2':{
                            $punitario = $pt->precio2;
                            break;
                        }
                        case 'P3':{
                            $punitario = $pt->precio3;
                            break;
                        }
                        default: break;
                    }
                }
                ?>
                {{\App\Tool::convertMoney($punitario)}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->cantidad}}</td>
            <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney(($row->precio))}}</td>
        </tr>
    @endforeach
</table>
@if($venta->estado=='c')
    <h2 ALIGN="right">
        VENTA ANULADA
    </h2>
@elseif($venta->tipo_pago=='Credito')
        <table   width="95%">

            <tr>
                <td align="right" ><strong>TOTAL PAGAR:</strong></td>
                <td align="right">{{\App\Tool::convertMoney($venta->totalPrecio())}}</td>
            </tr>
            <tr>
                <td align="right"><strong>TOTAL PAGADO:</strong></td>
                <td align="right" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($venta->totalPrecio() - $venta->getTotalDeuda())}}</td>
            </tr>
            <tr>
                <td align="right"  ><strong>SALDO:</strong></td>
                <td align="right">{{\App\Tool::convertMoney($venta->getTotalDeuda())}}</td>
            </tr>

        </table>
    @else
    <table   width="95%">
        <tr>
            <td align="right" ><strong>TOTAL PAGAR:</strong></td>
            <td align="right">{{\App\Tool::convertMoney($venta->totalPrecio())}}</td>
        </tr>
        <tr>
            <td align="right"><strong>IMPORTE:</strong></td>
            <td align="right" style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($venta->abono)}}</td>
        </tr>
        <tr>
            <td align="right"  ><strong>CAMBIO:</strong></td>
            <td align="right">{{\App\Tool::convertMoney(($venta->abono)-($venta->totalPrecio()))}}</td>
        </tr>
    </table>
    @endif
<table width="40%">
    <tr>
        <td align="center">{{$venta->sucursal->nombre}}- {{$venta->sucursal->ciudad->nombre}}</td>
    </tr>
    <tr>
        <td align="center">Tel: {{$venta->sucursal->telefono}} - Dir: {{$venta->sucursal->direccion}}</td>
    </tr>
    <tr >
        <td align="center"> <b>Gracias por su Preferencia!!</b></td>
    </tr>
</table>