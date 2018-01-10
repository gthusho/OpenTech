<table class="table table-striped">
    <thead>
    <tr >
        <th class="text-center">ESTADO</th>
        <th class="text-center">FECHA</th>
        <th class="text-center">SUCURSAL</th>
        <th width="10%" class="text-right">APERTURA</th>
        <th width="10%" class="text-right">CIERRE</th>
        <th class="text-center">USUARIO</th>

        <th colspan="3" class="text-center">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cajas as $row)
        <tr>
            <td class="text-center"><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td class="text-center">{{date('d/m/Y',strtotime($row->registro))}}</td>
            <td class="text-center">{{$row->sucursal->nombre}}</td>
            <td class="text-right">{{\App\Tool::convertMoney($row->apertura)}}</td>
            <td class="text-right">{{\App\Tool::convertMoney($row->cierre)}}</td>
            <td class="text-center">{{$row->usuario->nombre}}</td>

            {{--<td class="text-center">--}}
                {{--<a href="{{route('admin.cajavistas.edit',$row->id)}}" class="btn btn-success btn-sm"> <i class=" icon-eye fa-2x"></i>  </a>--}}
            {{--</td>--}}
            <td class="text-center">
                <a href="{{route('admin.caja.edit',$row->id)}}" class="btn btn-primary btn-sm"> <i class=" icon-pencil fa-2x"></i>  </a>
            </td>
            <td class="text-center">
                <a href="{{route('admin.caja.show',$row->id)}}" class="btn btn-danger btn-sm"> <i class=" icon-wallet fa-2x"></i>  </a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>