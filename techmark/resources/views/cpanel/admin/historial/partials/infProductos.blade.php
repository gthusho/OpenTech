<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">VENTAS DE PRODUCTOS</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
            <tr class="bg-custom ">
                <th class="text-white">CODIGO</th>
                <th class="text-white">TIPO</th>
                <th class="text-white">SUCURSAL</th>
                <th class="text-white">FECHA</th>
                <th class="text-white">CANTIDAD</th>
                <th class="text-white">PRECIO TOTAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($historial->ventaproducto as $fila)
                    <tr>
                        <td>{{$fila->getCode()}}</td>
                        @if($fila->estado=='c')
                            <td>Anulado</td>
                        @else
                            <td>{{$fila->tipo_pago}}</td>
                        @endif
                        <td>{{$fila->sucursal->nombre}}</td>
                        <td>{{date('d/m/Y',strtotime($fila->registro))}}</td>
                        <td>{{$fila->totalCantidad()}}</td>
                        <td>{{\App\Tool::convertMoney($fila->totalPrecio())}}</td>
                    </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="bg-inverse text-white"><b>TOTAL:</b></td>
                <td class="bg-inverse text-white"><b>{{$historial->cantVenPrd()}}</b></td>
                <td class="bg-inverse text-white"><b>{{\App\Tool::convertMoney($historial->totVenPrd())}}</b></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">COTIZACIONES DE PRODUCTOS</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
            <tr class="bg-custom ">
                <th class="text-white">SUCURSAL</th>
                <th class="text-white">FECHA</th>
                <th class="text-white">CANTIDAD</th>
                <th class="text-white">PRECIO TOTAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($historial->cotizacionproducto as $fila)
                <tr>
                    <td>{{$fila->sucursal->nombre}}</td>
                    <td>{{date('d/m/Y',strtotime($fila->registro))}}</td>
                    <td>{{$fila->totalCantidad()}}</td>
                    <td>{{\App\Tool::convertMoney($fila->totalPrecio())}}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td class="bg-inverse text-white"><b>TOTAL:</b></td>
                <td class="bg-inverse text-white"><b>{{$historial->cantCotPrd()}}</b></td>
                <td class="bg-inverse text-white"><b>{{\App\Tool::convertMoney($historial->totCotPrd())}}</b></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">VISITAS REALIZADAS</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
            <tr class="bg-custom ">
                <th class="text-white">QUIEN VISITO</th>
                <th class="text-white">FECHA</th>
                <th class="text-white">DIRECCION</th>
                <th class="text-white">MEDIDOS</th>
                <th class="text-white">PRODUCIDOS</th>
                <th class="text-white">GENERAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($historial->visita as $fila)
                <tr>
                    <td>{{$fila->usuario->nombre}}</td>
                    <td>{{date('d/m/Y',strtotime($fila->fecha))}}</td>
                    <td>{{$fila->direccion}}
                        @if($fila->barrio != null || $fila->barrio != '')
                            <br><b class="text-primary">BARRIO: </b>{{$fila->barrio}}
                        @endif
                        @if($fila->zona != null || $fila->zona != '')
                            <br><b class="text-primary">ZONA:</b> {{$fila->zona}}
                        @endif</td>
                    <td>{{$fila->cantMedidos()}}</td>
                    <td>{{$fila->cantProducidos()}}</td>
                    <td>{{$fila->cantMedidos() + $fila->cantProducidos()}}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td class="bg-inverse text-white"><b>TOTAL:</b></td>
                <td class="bg-inverse text-white"><b>{{$historial->cantMed()}}</b></td>
                <td class="bg-inverse text-white"><b>{{$historial->cantPrd()}}</b></td>
                <td class="bg-inverse text-white"><b>{{$historial->cantMed() + $historial->cantPrd()}}</b></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>