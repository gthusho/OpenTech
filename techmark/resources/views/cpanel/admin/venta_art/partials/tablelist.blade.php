<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th  class='bg-primary'>TIPO PAGO</th>
                <th>CODIGO</th>
                <th>FECHA</th>
                <th>SUCURSAL</th>
                <th>ALMACEN</th>
                <th>CLIENTE</th>
                <th>CANTIDAD ARTICULOS</th>
                <th>PRECIO TOTAL</th>
                <th class="text-center" colspan="2">ACCIONES</th>
            </tr>
            </thead>

            <tbody>
                @foreach($ventas as $row)
                    <?php
                    $cl = '';
                    if($row->tipo_pago == "Credito" && $row->getTotalDeuda()!=0)
                        $cl="class='bg-primary'" ;
                    ?>
                    <tr >
                        <td {!! $cl !!}>
                            {{$row->tipo_pago}}
                            @if($row->tipo_pago == "Credito" && $row->getTotalDeuda()!=0)
                                <a href="{{route('admin.venta-credito-art.show',$row->id)}}" class="btn btn-xs btn-white" target="_blank"> <i class="fa fa-money"></i> Pagar</a>
                            @endif
                        </td>

                        <td  >{{$row->getCode()}}</td>
                        <td>
                            {{date('d/m/Y',strtotime($row->registro))}}
                        </td>
                        <td>{{$row->sucursal->nombre}}</td>
                        <td>{{$row->almacen->nombre}}</td>
                        <td>
                            {{($row->cliente->razon_social)}}
                            <br><b class="text-primary">NIT: {{$row->cliente->nit}}</b>
                        </td>
                        <td>{{$row->totalCantidad()}}</td>
                        <td>
                            {{\App\Tool::convertMoney($row->totalPrecio())}}
                        </td>
                        <td class="text-center">
                            <a href="{{route('admin.venta_art.edit',$row->id)}}" class="btn btn-primary btn-sm"> <i class="icon-pencil fa-2x"></i> </a>
                        </td>
                        <td class="text-center">
                            <a href="{{url('reportes/venta').'?id='.$row->id}}" class="btn btn-primary btn-sm"
                               target="_blank"> <i class=" icon-printer fa-2x"></i>  </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
