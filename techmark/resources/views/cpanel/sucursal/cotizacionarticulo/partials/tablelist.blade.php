<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th>CODIGO</th>
                <th>FECHA</th>
                <th>CLIENTE</th>
                <th>SUCURSAL</th>
                <th>CANTIDAD DE ARTICULOS</th>
                <th>TOTAL COTIZACION</th>
                <th class="text-center" colspan="2">ACCIONES</th>
            </tr>
            </thead>

            <tbody>
                @foreach($cotizaciones as $row)
                    <tr>
                        <td  >{{$row->getCode()}}</td>
                        <td>
                            {{date('d/m/Y',strtotime($row->registro))}}
                        </td>
                        <td>
                        {{($row->cliente->razon_social)}}
                        <br><b class="text-primary">NIT: {{$row->cliente->nit}}</b>
                        </td>
                        <td>{{$row->sucursal->nombre}}</td>
                        <td>{{$row->totalCantidad()}}</td>
                        <td>
                            {{\App\Tool::convertMoney($row->totalPrecio())}}
                        </td>

                        <td>
                            <a href="{{route('s.cotizacion.edit',$row->id)}}" class="btn btn-primary btn-sm">
                                <i class="icon-pencil fa-2x"></i></a>
                        </td>
                        <td>
                            <a href="{{url('reportes/cotizacion/articulo').'?id='.$row->id}}" class="btn btn-primary btn-sm"
                               target="_blank"> <i class=" icon-printer fa-2x"></i> </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
