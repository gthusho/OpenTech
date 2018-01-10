<style>
    h5{
        margin: 0px 0px 0px 0px;
    }
</style>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">VENTAS DE ARTICULOS</h3>
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
            @foreach($historial->ventaarticulo as $fila)
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
                <td class="bg-inverse text-white"><b>{{$historial->cantVenArt()}}</b></td>
                <td class="bg-inverse text-white"><b>{{\App\Tool::convertMoney($historial->totVenArt())}}</b></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">COTIZACIONES DE ARTICULOS</h3>
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
            @foreach($historial->ventaarticulo as $fila)
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
                <td class="bg-inverse text-white"><b>{{$historial->cantCotArt()}}</b></td>
                <td class="bg-inverse text-white"><b>{{\App\Tool::convertMoney($historial->totCotArt())}}</b></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">PRODUCCIONES REALIZADAS</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
            <tr class="bg-custom ">
                <th class="text-white">CODIGO</th>
                <th class="text-white">ESTADO</th>
                <th class="text-white">SUCURSAL</th>
                <th class="text-white">FECHA</th>
                <th class="text-white">CANTIDAD</th>
                <th class="text-white">PRECIO TOTAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($historial->produccion as $fila)
                <tr>
                    <td>{{$fila->getCode()}}</td>
                    <td>
                        @if($fila->checkState()[1]=='p'&& $fila->terminado==0)En Produccion
                        @elseif($fila->checkState()[1]=='t' && $fila->terminado==1) Entregado

                        @elseif($fila->checkState()[1]=='c' && $fila->terminado==1)Cancelada
                        @elseif($fila->checkState()[1]=='e')Terminada
                        @endif
                    </td>
                    <td>{{$fila->sucursal->nombre}}</td>
                    <td>{{date('d/m/Y',strtotime($fila->inicio))}} - {{date('d/m/Y',strtotime($fila->inicio))}}</td>
                    <td>{{$fila->totalCantidad()}}</td>
                    <td>{{\App\Tool::convertMoney($fila->precio)}}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="bg-inverse text-white"><b>TOTAL:</b></td>
                <td class="bg-inverse text-white"><b>{{$historial->cantProd()}}</b></td>
                <td class="bg-inverse text-white"><b>{{\App\Tool::convertMoney($historial->totProd())}}</b></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
