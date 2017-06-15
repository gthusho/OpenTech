<table class="table table-striped">
    <thead>
    <tr>
        <th>IdProveedor</th>
        <th>Nit</th>
        <th>Razon Social</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Foto</th>
        <th>Ult. Modificacion</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($proveedores as $row)
        <tr>
            <td>{{$row->IdProveedor}}</td>
            <td>{{$row->Nit}}</td>
            <td>{{$row->RazonSocial}}</td>
            <td>{{$row->Direccion}}</td>
            <td>{{$row->Telefono}}</td>
            <td>{{$row->CorreoElectronico}}</td>
            <td>{{$row->Foto}}</td>
            <td>{{$row->FechaModificacion}}</td>
            <td>
                <a href="{{route('admin.proveedor.edit',$row->IdProveedor)}}"><i class="icon-pencil"> Editar </i></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>