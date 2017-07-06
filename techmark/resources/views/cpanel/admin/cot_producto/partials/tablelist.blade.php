<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th class='bg-primary'>CODIGO</th>
                <th>FECHA</th>
                <th>SUCURSAL</th>
                <th>CLIENTE</th>
                <th>CANTIDAD PRODUCTOA</th>
                <th>PRECIO TOTAL</th>
                <th>ACCIONES</th>
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
                        <td  >{{$row->getCode()}}</td>
                        <td>
                            {{date('d/m/Y',strtotime($row->registro))}}
                        </td>
                        <td>{{$row->sucursal->nombre}}</td>
                        <td>{{$row->cliente->razon_social}}</td>
                        <td>{{$row->totalCantidad()}}</td>
                        <td>
                            {{\App\Tool::convertMoney($row->totalPrecio())}}
                        </td>
                        <td>
                            <a href="{{route('admin.cot_producto.edit',$row->id)}}"> <i class="icon-pencil"></i> Editar </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>