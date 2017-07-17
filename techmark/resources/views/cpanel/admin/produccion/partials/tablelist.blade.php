<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover m-0  table-actions-bar" id="tabla">
            <thead>
            <tr>
                <th>ESTADO</th>
                <th>CODIGO</th>
                <th>FECHA</th>
                <th>SUCURSAL</th>
                <th>DESTINO</th>
                <th>A CARGO</th>
                <th>CANTIDAD ARTICULOS</th>
                <th>PRECIO TOTAL</th>
                <th colspan="3">ACCIONES</th>
            </tr>
            </thead>

            <tbody>
                @foreach($producciones as $row)
                    <tr >
                        <td>
                            <span class="label label-{{$row->checkState()[2]}}">
                                {{$row->checkState()[0]}}
                            </span>

                        </td>
                        <td  >{{$row->getCode()}}</td>
                        <td>
                            {{$row->fecha}}
                        </td>
                        <td>{{$row->sucursal->nombre}}</td>
                        <td>{{$row->destino}}</td>
                        <td>{{$row->trabajador->nombre}}</td>
                        <td>{{$row->totalCantidad()}}</td>
                        <td>
                            {{\App\Tool::convertMoney($row->totalPrecio())}}
                        </td>
                        <td>
                            <a href="#" class="btn btn-inverse btn-sm">  <i class=" ti-printer fa-2x"></i></a>
                        </td>
                        <td>
                            @if($row->checkState()[1]!='t')
                            <a href="{{route('admin.produccion.edit',$row->id)}}" class="btn btn-primary btn-sm "> <i class="icon-pencil fa-2x"></i>  </a>
                            @endif
                        </td>
                        <td>
                            @if($row->checkState()[1]=='e')
                                <a href="" class="btn btn-{{$row->checkState()[2]}} btn-sm"> A Inventario <i class="  ti-announcement fa-2x"></i></a>
                            @elseif($row->checkState()[1]=='t')
                                <i class="  ti-lock fa-2x"></i>
                            @elseif($row->checkState()[1]=='p')
                                <i class="  ti-unlock fa-2x"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
