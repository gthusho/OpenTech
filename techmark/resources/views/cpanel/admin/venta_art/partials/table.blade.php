<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th>#</th>
                <th>ARTICULO</th>
                <th>CATEGORIA</th>
                <th>MARCA</th>
                <th>MATERIAL</th>
                <th>CANTIDAD</th>
                <th>UNIDAD</th>
                <TH>PRECIO UNITARIO</TH>
                <th>TOTAL</th>
                <th>REMOVER</th>
            </tr>
            </thead>

            <tbody>
                <?php $i=1; ?>
                @foreach($venta->detalleventas as $row)
                    <tr class="rows" data-id="{{$row->id}}">
                        <td>{{$i++}}</td>
                        <td>
                            {{$row->articulo->nombre}}

                        </td>
                        <td>
                            {{\App\ToolArticuloCart::getNombreById($row->articulo->categoria_articulo_id,'categoria')}}
                        </td>
                        <td>
                            {{\App\ToolArticuloCart::getNombreById($row->articulo->marca_id,"marca")}}
                        </td>
                        <td> {{\App\ToolArticuloCart::getNombreById($row->articulo->material_id,"material")}}</td>
                        <td>{{number_format((float)$row->cantidad, 2, '.', '')}}</td>
                        <td>{{\App\ToolArticuloCart::getNombreById($row->articulo->unidad_id,"unidad")}}</td>
                        <td>
                            {{\App\Tool::convertMoney($row->articulo->getPrecio($row->dp))}}
                        </td>
                        <td>
                            {{\App\Tool::convertMoney($row->precio)}}
                        </td>
                        <td>
                            @if(Request::segment(4)!='edit')
                            {!! Form::open(['route'=>['deleteItemsVentaArticulo',$row->id],'method'=>'post']) !!}
                            <button class="btn btn-danger btn-sm" ><i class=" icon-trash"></i> Remover</button>
                            {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
