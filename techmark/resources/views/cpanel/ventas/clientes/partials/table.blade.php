<table class="table table-hover">
    <thead>
    <tr>
        <th>NOMBRE Y/O RAZON SOCIAL</th>
        <th>TELEFONO</th>
        <th>DIRECCION</th>
        <th>EMAIL</th>
        <th>POR</th>
        <th>FOTOGRAFIA</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($clientes as $row)
        <tr>
            <td>
                {{($row->RazonSocial)}}
                <br><b class="text-primary">NIT: {{$row->Nit}}</b>
            </td>
            <td>{{($row->Telefono)}}</td>
            <td>{{$row->Direccion}}</td>
            <td>{{($row->CorreoElectronico)}}</td>
            <td>{{($row->usuario->Nombre)}}</td>
            <td>
                <img src="{{asset('imagenes/clientes/'.$row->Foto)}}" alt="{{$row->Foto}}" height="100px" width="100px" class="img-thumbnail">

            </td>
            <td>
        
                <a href="{{route('admin.cliente.edit',$row->IdCliente)}}"> <i class="icon-pencil"></i> Editar </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>