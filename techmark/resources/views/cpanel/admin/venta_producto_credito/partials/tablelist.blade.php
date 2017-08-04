<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th>CODIGO</th>
                <th>FECHA</th>
                <th>SUCURSAL</th>
                <th class="text-right">C/P</th>
                <th class="text-right">TOTAL</th>
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
                            {{date('d/m/Y',strtotime($row->fecha))}}
                        </td>
                        <td>{{$row->sucursal->nombre}}</td>
                        <td class="text-right">{{$row->totalCantidad()}}</td>
                        <td class="text-right">{{\App\Tool::convertMoney($row->totalPrecio())}}</td>
                        <td class="text-right">{{\App\Tool::convertMoney($row->getTotalAbonos())}}</td>
                        <td class="text-right"><b>{{\App\Tool::convertMoney($row->getTotalDeuda())}}</b></td>

                        <td class="text-center">
                            <a href="{{route('admin.ventas.creditos.productos.show',$row->id)}}" class="btn btn-primary btn-sm"> <i class="fa  fa-money fa-2x"></i></a>
                        </td>
                        <td class="text-center">
                            <button onclick="printJS('{{url('reportes/pagos/venta/productos').'?id='.$row->id}}')" class="btn btn-primary btn-sm"> <i class=" icon-printer fa-2x"></i> </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
