<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th>ESTADO</th>
                <th class='bg-primary'>CODIGO</th>
                <th>FECHA</th>
                <th>SUCURSAL</th>
                <th>CLIENTE</th>
                <th>CANTIDAD PRODUCTO</th>
                <th>PRECIO TOTAL</th>
                <th class="text-center" colspan="2">ACCIONES</th>
            </tr>
            </thead>

            <tbody>
                @foreach($cotizaciones as $row)
                    <?php
                    $cl = '';
                    if($row->tipo_pago == "Credito")
                        $cl="class='bg-primary'" ;
                    ?>
                    <tr >
                        <td><span class="label label-{{$row->estado()[0]}}">{{$row->estado()[1]}}</span></td>
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
                        <td>
                            <a href="{{route('admin.cot_producto.edit',$row->id)}}" class="btn btn-primary btn-sm"> <i class="icon-pencil fa-2x"></i> </a>
                        </td>
                        <td>
                            <button onclick="printJS('{{url('reportes/cotizacion/producto').'?id='.$row->id}}')" class="btn btn-primary btn-sm"> <i class=" icon-printer fa-2x"></i> </button>
                        </td>
                        @if($row->estado()==['default', 'Activo'])
                            <td>
                                <a href="{{route('admin.clientes.produccion.show',$row->id)}}" class="btn btn-warning btn-sm"> <i class="ti-announcement fa-2x"></i>  Adjudicada</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
