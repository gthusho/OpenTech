<br>
<table width="80%" >
    <tr>
        <td ><strong>CODIGO</strong></td>
        <td >{{$produccion2->getCode()}}</td>
    </tr>

    <tr>
        <td><strong>SUCURSAL:</strong></td>
        <td>{{$produccion2->sucursal->nombre}}</td>
    </tr>
    <tr>
        <td><strong>CLIENTE:</strong></td>
        <td>{{$produccion2->cliente->razon_social}}</td>
    </tr>
    <?php
    $fechas=explode('-',$produccion2->fecha);
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
        <td><strong>TOTAL PRECIO CONFECCION</strong></td>
        <td>{{\App\Tool::convertMoney($produccion2->precio)}}</td>
    </tr>
    <tr>
        <td><strong>PAGO EFECTIVO</strong></td>
        <td>{{\App\Tool::convertMoney($produccion2->adelanto)}}</td>
    </tr>
    <tr>
        <td><strong>SALDO</strong></td>
        <td>{{\App\Tool::convertMoney(($produccion2->precio - $produccion2->adelanto))}}</td>
    </tr>

    <tr>
        <td COLSPAN="2"><strong>DESCRIPCION DE LA PRODUCCION:</strong></td>

    </tr>
    <tr>
        <td COLSPAN="2">{{$produccion2->destino}}</td>
    </tr>
</table>
<br><br><br><br><br>
<table>
    <tr>
        <td width="40%">
            <table >
                <tr>
                    <td align="center">{{$produccion2->sucursal->nombre}}- {{$produccion2->sucursal->ciudad->nombre}}</td>
                </tr>
                <tr>
                    <td align="center">Tel: {{$produccion2->sucursal->telefono}} - Dir: {{$produccion2->sucursal->direccion}}</td>
                </tr>
                <tr >
                    <td align="center"> <b>Gracias por su Preferencia!!</b></td>
                </tr>
            </table>

        </td>
        <td width="30%">
            <table >
                <tr>
                    <td align="center">{{$produccion2->trabajador->nombre}}</td>
                </tr>
                <tr>
                    <td align="center">C.I.:{{$produccion2->trabajador->ci}}</td>
                </tr>
                <tr >
                    <td align="center"> <b>VENDEDOR</b></td>
                </tr>
            </table>

        </td>
        <td width="30%">

            <table >
                <tr>
                    <td align="center">{{$produccion2->cliente->razon_social}}</td>
                </tr>
                <tr>
                    <td align="center">NIT: {{$produccion2->cliente->nit}}</td>
                </tr>
                <tr >
                    <td align="center"> <b>CLIENTE</b></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
