<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th>CODIGO</th>
                <th>FECHA</th>
                <th>SUCURSAL</th>
                <th class="text-right">CANTIDAD ARTICULOS</th>
                <th class="text-right">COSTO TOTAL</th>
                <th class="text-right">ABONO</th>
                <th class="text-right">SALDO</th>
                <th class="text-right">ACCIONES</th>
            </tr>
            </thead>

            <tbody>
                @foreach($compras as $row)
                    <tr >
                        <td  ><b>{{$row->getCode()}}</b></td>
                        <td>
                            {{date('d/m/Y',strtotime($row->fecha))}}
                        </td>
                        <td>{{$row->sucursal->nombre}}</td>
                        <td class="text-right">{{$row->totalCantidad()}}</td>
                        <td class="text-right">{{\App\Tool::convertMoney($row->totalCosto())}}</td>
                        <td class="text-right">{{\App\Tool::convertMoney($row->getTotalAbonos())}}</td>
                        <td class="text-right"><b>{{\App\Tool::convertMoney($row->getTotalDeuda())}}</b></td>

                        <td class="text-right">
                            <a href="{{route('admin.compra-credito.show',$row->id)}}"> <i class="fa  fa-money"></i></a>
                        </td>
                        <td>
                            <a href="{{url('reportes/pagos/compra').'?id='.$row->id}}"
                               target="_blank"> <i class=" icon-printer"></i> </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
