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
                <th>ACCIONES</th>
            </tr>
            </thead>

            <tbody>
                @foreach($ventas as $row)
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
                            <a href="{{route('admin.cotizacion.edit',$row->id)}}"> <i class="icon-pencil"></i> Editar </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
