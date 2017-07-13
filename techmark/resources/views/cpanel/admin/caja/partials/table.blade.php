<table class="table table-striped">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>USUARIO</th>
        <th>SUCURSAL</th>
        <th>APERTURA</th>
        <th>CIERRE</th>
        <th>OBSERVACIONES</th>
        <th>FECHA</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cajas as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{$row->usuario->nombre}}</td>
            <td>{{$row->sucursal->nombre}}</td>
            <td>{{\App\Tool::convertMoney($row->apertura)}}</td>
            <td>{{\App\Tool::convertMoney($row->cierre)}}</td>
            <td>{{$row->observaciones}}</td>
            <td>{{date('d/m/Y',strtotime($row->registro))}}</td>
            <td>
                <a href="{{route('admin.caja.edit',$row->id)}}"> <i class=" icon-pencil"></i> Editar </a>
                <br>
                <a href="{{route('admin.caja.show',$row->id)}}"> <i class=" icon-wallet"></i> Cerrar </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>