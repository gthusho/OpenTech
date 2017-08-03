<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th>#</th>
                <th>IMAGEN</th>
                <th>PRODUCTO</th>
                <th>TALLA</th>
                <th>PRECIO</th>
                <th>CANTIDAD</th>
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
                            <img src="{{$row->producto->getImagen()}}" alt="" class="img img-thumbnail thumb-sm">
                        </td>
                        <td>
                            {{$row->producto->descripcion}}

                        </td>
                        <td>
                            {{$row->talla->nombre}}
                        </td>
                        <td>{{\App\Tool::convertMoney($row->precio)}}</td>
                        <td>{{$row->cantidad}}</td>
                        <td>{{\App\Tool::convertMoney(($row->precio*$row->cantidad))}}</td>
                        <td>
                            {!! Form::open(['route'=>['vpd.destroyItemCar',$row->id],'method'=>'delete']) !!}
                            <button class="btn btn-danger btn-sm" ><i class=" icon-trash fa-2x"></i> </button>
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
