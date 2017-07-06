<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th>#</th>
                <th>PRODUCTO</th>
                <th>DESCRIPCION</th>
                <th>TALLA</th>
                <th>MATERIAL</th>
                <th>CANTIDAD</th>
                <th>PRECIO</th>
                <th>REMOVER</th>
            </tr>
            </thead>

            <tbody>
                <?php $i=1; ?>
                @foreach($cotizacion->detalle as $row)
                    <tr class="rows" data-id="{{$row->id}}">
                        <td>{{$i++}}</td>
                        <td>
                            {{$row->productobase->descripcion}}

                        </td>
                        <td>
                            {{$row->descripcion}}
                        </td>
                        <td>
                            {{$row->talla->nombre}}
                        </td>
                        <td> {{$row->material->nombre}}</td>
                        <td>{{number_format((float)$row->cantidad, 2, '.', '')}}</td>
                        <td>
                            {{\App\Tool::convertMoney($row->precio)}}
                        </td>
                        <td>
                            {!! Form::open(['route'=>['deleteItemsCotizacionProducto',$row->id],'method'=>'post']) !!}
                            <button class="btn btn-danger btn-sm" ><i class=" icon-trash"></i> Remover</button>
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
