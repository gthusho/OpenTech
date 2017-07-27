<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th>CODIGO</th>
                <th>FECHA</th>
                <th>SUCURSAL</th>
                <th>CLIENTE</th>
                <th class="text-right">CANTIDAD ARTICULOS</th>
                <th class="text-right">COSTO TOTAL</th>
                <th class="text-right">ABONO</th>
                <th class="text-right">SALDO</th>
                <th class="text-center" colspan="2">ACCIONES</th>
            </tr>
            </thead>

            <tbody>
                @foreach($ventas as $row)
                    <tr >
                        <td  ><b>{{$row->getCode()}}</b></td>
                        <td>
                            {{date('d/m/Y',strtotime($row->registro))}}
                        </td>
                        <td>{{$row->sucursal->nombre}}</td>
                        <td>{{$row->cliente->razon_social}}</td>
                        <td class="text-right">{{$row->totalCantidad()}}</td>
                        <td class="text-right">{{\App\Tool::convertMoney($row->totalPrecio())}}</td>
                        <td class="text-right">{{\App\Tool::convertMoney($row->getTotalAbonos())}}</td>
                        <td class="text-right"><b>{{\App\Tool::convertMoney($row->getTotalDeuda())}}</b></td>

                        <td class="text-center">
                            @if($row->getTotalDeuda()!=0)
                            <a href="{{route('s.venta-credito-art.show',$row->id)}}" class="btn btn-primary btn-sm"> <i class="fa  fa-money fa-2x"></i></a>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{url('reportes/pagos/venta').'?id='.$row->id}}" class="btn btn-primary btn-sm"
                               target="_blank"> <i class=" icon-printer fa-2x"></i> </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
