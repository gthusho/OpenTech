<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">INFORMACION CAJA</h3>
    </div>
    <div class="panel-body">
        <ul class="list-unstyled">
            <P></P>
            <ul class="list-unstyled">
                <li><span class="text-custom">Fecha Apertura: </span>{{$caja->registro}}</li>
                <li><span class="text-custom">Fecha Cierre: </span>{{$caja->fcierre}}</li>
                <li><span class="text-custom">Usuario Caja: </span>{{$caja->usuario->nombre}}</li>
                <li><span class="text-custom">Sucursal: </span>{{$caja->sucursal->nombre}}</li>
                <li><span class="text-custom">Monto de Apertura: </span>{{\App\Tool::convertMoney($caja->apertura)}}</li>
                <li><span class="text-custom">Monto Cierre: </span>{{\App\Tool::convertMoney($caja->cierre)}}</li>
            </ul>
            <table  cellspacing="5">

                @foreach($caja as $row)

                @endforeach

            </table>

        </ul>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">OBSERVACIONES</h3>
    </div>
    <div class="panel-body">
        <tr>
            <td>{{$caja->observaciones}}</td>
        </tr>

    </div>
</div>
