<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table " id="tabla">
            <thead>
            <tr>
                <th>CODIGO</th>
                <th>FECHA</th>
                <th>TIPO COMPRA</th>
                <th>SUCURSAL</th>
                <th>ALMACEN</th>
                <th>PROVEEDOR</th>
                <th>CANTIDAD ARTICULOS</th>
                <th>COSTO TOTAL</th>
                <th>ACCIONES</th>
            </tr>
            </thead>

            <tbody>
                @foreach($compras as $row)
                    <?php
                    $cl = '';
                    if($row->tipo_compra == "Credito")
                        $cl="class='bg-custom text-white'" ;
                    ?>
                    <tr {!! $cl !!}>

                        <td  >{{$row->getCode()}}</td>
                        <td>
                            {{date('d/m/Y',strtotime($row->fecha))}}
                        </td>
                        <td>{{$row->tipo_compra}}</td>
                        <td>{{$row->sucursal->nombre}}</td>
                        <td>{{$row->almacen->nombre}}</td>
                        <td>{{$row->proveedor->razon_social}}</td>
                        <td>{{$row->totalCantidad()}}</td>
                        <td>
                            {{\App\Tool::convertMoney($row->totalCosto())}}
                        </td>
                        <td>
                            <a href="{{route('admin.compra.edit',$row->id)}}"> <i class="icon-pencil"></i> Editar </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
