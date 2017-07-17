<table class="table table-striped">
    <thead>
    <tr>
        <th>USUARIO</th>
        <th>SUCURSAL</th>
        <th>DESCRIPCION</th>
        <th>MONTO</th>
        <th>FECHA</th>
        <th class="text-center">Acciones</th>
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
            <td class="text-center">
                <a href="{{route('admin.gasto.edit',$row->id)}}" class="btn btn-primary btn-sm"> <i class=" icon-pencil fa-2x"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>