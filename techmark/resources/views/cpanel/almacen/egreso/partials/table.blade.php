<table class="table table-striped">
    <thead>
    <tr>
        <th>Articulo</th>
        <th>Almacen</th>
        <th>Cantidad</th>
        <th>Observaciones</th>
        <th>Fecha Egreso</th>
        <th>Usuario</th>
        <th>Fecha Registro</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($egresos as $row)
        <tr>
            <td>{{$row->articulo->Descripcion}}</td>
            <td>{{$row->almacen->Descripcion}}</td>
            <td>{{$row->Cantidad}}</td>
            <td>{{$row->Observacion}}</td>
            <td>{{$row->FechaEgreso}}</td>
            <td>{{$row->registro}}</td>
            <td>{{$row->usuario->NombreUsuario}}</td>
            <td>
                <a href="{{route('admin.egreso.edit',$row->IdEgreso)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>