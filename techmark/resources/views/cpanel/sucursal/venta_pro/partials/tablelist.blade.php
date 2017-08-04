<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th  class='bg-primary'>TIPO PAGO</th>
                <th>CODIGO</th>
                <th>FECHA</th>
                <th>SUCURSAL</th>
                <th>CLIENTE</th>
                <th>C/U</th>
                <th>PRECIO TOTAL</th>
                <th class="text-center" colspan="2">ACCIONES</th>
            </tr>
            </thead>

            <tbody>
            @foreach($ventas as $row)
                <?php
                $cl = '';
                if($row->tipo_pago == "Credito" && $row->getTotalDeuda()>0)
                    $cl="class='bg-primary'" ;
                if($row->estado=='c')
                    $cl = "class='bg-inverse text-white'";
                ?>
                <tr >
                    <td {!! $cl !!}>

                        @if($row->estado=='c')
                            <b>Anulado</b>
                        @else
                            {{$row->tipo_pago}}
                            @if($row->tipo_pago == "Credito" && $row->getTotalDeuda()>0)
                                <a href="{{route('s.ventas.creditos.productos.show',$row->id)}}" class="btn btn-xs btn-white pull-right" target="_blank"> <i class="fa fa-money"></i> Pagar</a>
                            @endif
                        @endif

                    </td>

                    <td  >{{$row->getCode()}}</td>
                    <td>
                        {{date('d/m/Y',strtotime($row->registro))}}
                    </td>
                    <td>{{$row->sucursal->nombre}}</td>
                    <td>
                        {{($row->cliente->razon_social)}}
                        <br><b class="text-primary">NIT: {{$row->cliente->nit}}</b>
                    </td>
                    <td>{{$row->totalCantidad()}}</td>
                    <td>
                        {{\App\Tool::convertMoney($row->totalPrecio())}}
                    </td>

                    <td class="text-center">
                        @if($row->estado!='c')
                            <a href="{{route('s.ventas.productos.edit',$row->id)}}" class="btn btn-primary btn-sm"> <i class="icon-pencil fa-2x"></i> </a>
                        @endif
                    </td>
                    <td class="text-center">
                        <button onclick="printJS('{{url('reportes/venta/producto').'?id='.$row->id}}')"  class="btn btn-primary btn-sm"> <i class=" icon-printer fa-2x"></i>  </button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>
