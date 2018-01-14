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
                <th>RESPONSABLE/CLIENTE</th>
                {{--<th>PRECIOS</th>--}}
                <th class="text-center" colspan="2">ACCIONES</th>
            </tr>
            </thead>

            <tbody>
                @foreach($producciones as $row)
                    <tr >
                        <td>
                            <span class="label label-{{$row->checkState()[2]}}">
                                {{$row->checkState()[0]}}
                            </span>
                            @if($row->precio != $row->adelanto && $row->terminado==1)
                                <br>
                                <span class="label text-inverse">{{\App\Tool::convertMoney($row->precio - $row->adelanto)}}</span>
                            @endif
                        </td>
                        <td  >{{$row->getCode()}}</td>
                        <td>
                            {{date('d/m/Y',strtotime($row->inicio))}} - {{date('d/m/Y',strtotime($row->fin))}}
                        </td>
                        <td>{{$row->sucursal->nombre}}</td>
                        <td>{{$row->destino}}</td>
                        <td>
                           <strong>Responsable:</strong>{{$row->trabajador->nombre}} <br>
                            <strong>Cliente:</strong>{{$row->cliente->razon_social}}</td>
                        {{--<td>--}}
                            {{--@if($row->totalPrecio()>0)--}}
                               {{--<strong>Produccion:</strong> {{\App\Tool::convertMoney($row->totalPrecio())}}--}}
                                {{--<br>--}}
                              {{--<strong>Confeccion:</strong>  {{\App\Tool::convertMoney($row->precio)}} <br>--}}
                              {{--<strong>Pago Efectivo:</strong> {{\App\Tool::convertMoney($row->adelanto)}} <br>--}}
                                {{--<strong>Saldo: </strong> {{\App\Tool::convertMoney($row->precio - $row->adelanto)}}--}}
                            {{--@else--}}
                                {{--<span class="text-danger">{{\App\Tool::convertMoney($row->totalPrecio())}}</span>--}}
                            {{--@endif--}}
                        {{--</td>--}}
                        <td>
                            <button onclick="printJS('{{url('reportes/clientes/producciones').'?code='.$row->id}}')"
                               href="{{url('reportes/clientes/producciones').'?code='.$row->id}}"
                               class="btn btn-primary  btn-sm" >
                                <i class=" icon-printer fa-2x"></i></button>
                        </td>

                        <td>
                            @if($row->checkState()[1]=='p'&& $row->terminado==0)
                            <a href="{{route('admin.clientes.produccion.edit',$row->id)}}" class="btn btn-inverse btn-sm ">
                                <i class="icon-pencil fa-2x"></i>  </a>
                            @elseif($row->checkState()[1]=='e' && $row->terminado==0)
                                <a href="{{route('clientes.entregarProduccion',[$row->id,'sucursal'=>\App\Tool::slug($row->sucursal->nombre,false)])}}" class="btn btn-success btn-sm ">
                                    <i class=" icon-present fa-2x"></i>  </a>
                            @elseif($row->checkState()[1]=='t' && $row->terminado==1 && $row->precio != $row->adelanto)
                                <a href="{{route('clientes.saldar',$row->id)}}" class="btn btn-danger btn-sm " onclick="return confirm('Desea saldar la cuenta?')">
                                    <i class="icon-credit-card fa-2x"></i>  </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
