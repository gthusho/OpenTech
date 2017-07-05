<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th>#</th>
                <th>FECHA</th>
                <th>MONTO</th>
                <th>REGISTRO</th>
                <th>ACCION</th>
            </tr>
            </thead>

            <tbody>
                <?php $i=1; ?>
                @foreach($compra->pagos as $row)
                    <tr class="rows" data-id="{{$row->id}}">
                        <td>{{$i++}}</td>
                        <td>
                            {{date('d-m-Y',strtotime($row->fecha))}}
                        </td>
                        <td>
                            {{\App\Tool::convertMoney($row->abono)}}
                        </td>
                        <td>
                            {{$row->usuario->nombre}}
                        </td>
                        <td>
                            {!! Form::open(['route'=>['admin.compra-credito.destroy',$row->id],'method'=>'delete']) !!}
                            <button class="btn btn-danger btn-sm" ><i class=" icon-trash"></i> Remover</button>
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
