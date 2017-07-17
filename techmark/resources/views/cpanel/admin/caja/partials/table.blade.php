<table class="table table-striped">
    <thead>
    <tr >
        <th class="text-center">ESTADO</th>
        <th class="text-center">USUARIO</th>
        <th class="text-center">SUCURSAL</th>
        <th width="10%">APERTURA</th>
        <th width="10%">CIERRE</th>
        <th class="text-center">OBSERVACIONES</th>
        <th class="text-center">FECHA</th>
        <th colspan="3" class="text-center">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cajas as $row)
        <tr>
            <td class="text-center"><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{$row->usuario->nombre}}</td>
            <td>{{$row->sucursal->nombre}}</td>
            <td>{{\App\Tool::convertMoney($row->apertura)}}</td>
            <td>{{\App\Tool::convertMoney($row->cierre)}}</td>
            <td>{{$row->observaciones}}</td>
            <td class="text-center">{{date('d/m/Y',strtotime($row->registro))}}</td>
            <td class="text-center">
                <a href="{{route('admin.cajavistas.edit',$row->id)}}"> <i class=" icon-eye"></i>  </a>
            </td>
            <td class="text-center">
                <a href="{{route('admin.caja.edit',$row->id)}}"> <i class=" icon-pencil"></i>  </a>
            </td>
            <td class="text-center">
                <a href="{{route('admin.caja.show',$row->id)}}"> <i class=" icon-wallet"></i>  </a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>