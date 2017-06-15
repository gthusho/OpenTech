<table class="table table-striped">
    <thead>
    <tr>
        <th>ARTICULO</th>
        <th>ALMACEN</th>
        <th>CANTIDAD</th>
        <th>OBSERVACIONES</th>
        <th>FECHA INGRESO</th>
        <th>USUARIO</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ingresos as $row)
        <tr>
            <td>{{$row->articulo->Descripcion}}</td>
            <td>{{$row->almacen->Descripcion}}</td>
            <td>{{$row->Cantidad}}</td>
            <td>{{$row->Observacion}}</td>
            <td>{{$row->FechaIngreso}}</td>
            <td>{{$row->usuario->NombreUsuario}}</td>
            <td>
                <a href="{{route('admin.ingreso.edit',$row->IdIngreso)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>