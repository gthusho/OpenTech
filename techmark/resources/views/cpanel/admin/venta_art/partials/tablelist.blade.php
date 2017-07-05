<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th>CODIGO</th>
                <th>FECHA</th>
                <th>TIPO PAGO</th>
                <th>SUCURSAL</th>
                <th>ALMACEN</th>
                <th>CLIENTE</th>
                <th>CANTIDAD ARTICULOS</th>
                <th>PRECIO TOTAL</th>
                <th>ACCIONES</th>
            </tr>
            </thead>

            <tbody>
                @foreach($ventas as $row)
                    <?php
                    $cl = '';
                    if($row->tipo_pago == "Credito")
                        $cl="class='bg-warning'" ;
                    ?>
                    <tr {!! $cl !!}>

                        <td  >{{$row->getCode()}}</td>
                        <td>
                            {{date('d/m/Y',strtotime($row->registro))}}
                        </td>
                        <td>{{$row->tipo_pago}}</td>
                        <td>{{$row->sucursal->nombre}}</td>
                        <td>{{$row->almacen->nombre}}</td>
                        <td>{{$row->cliente->razon_social}}</td>
                        <td>{{$row->totalCantidad()}}</td>
                        <td>
                            {{\App\Tool::convertMoney($row->totalPrecio())}}
                        </td>
                        <td>
                            <a href="{{route('admin.venta_art.edit',$row->id)}}"> <i class="icon-pencil"></i> Editar </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
