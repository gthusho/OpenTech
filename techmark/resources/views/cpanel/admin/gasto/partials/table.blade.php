<table class="table table-striped">
    <thead>
    <tr>
        <th>USUARIO</th>
        <th>SUCURSAL</th>
        <th>DESCRIPCION</th>
        <th>MONTO</th>
        <th>FECHA</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($gastos as $row)
        <tr>
            <td>{{$row->usuario->nombre}}</td>
            <td>{{$row->sucursal->nombre}}</td>
            <td>{{$row->descripcion}}</td>
            <td>{{\App\Tool::convertMoney($row->monto)}}</td>
            <td>{{date('d/m/Y',strtotime($row->fecha))}}</td>
            <td>
                <a href="{{route('admin.gasto.edit',$row->id)}}"> <i class=" icon-pencil"></i> Editar </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>