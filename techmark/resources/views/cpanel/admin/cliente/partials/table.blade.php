<table class="table table-hover">
    <thead>
    <tr>
        <th>NOMBRE Y/O RAZON SOCIAL</th>
        <th>TELEFONO</th>
        <th>DIRECCION</th>
        <th>EMAIL</th>
        <th class="text-center">ACCIONES</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($clientes as $row)
        <tr>
            <td>
                {{($row->razon_social)}}
                <br><b class="text-primary">NIT: {{$row->nit}}</b>
            </td>
            <td>{{($row->telefono)}}</td>
            <td>{{$row->direccion}}</td>
            <td>{{($row->email)}}</td>
            <td class="text-center">
                <a href="{{route('admin.cliente.edit',$row->id)}}" class="btn btn-primary btn-sm"> <i class="icon-pencil fa-2x"></i></a>
                <a href="{{route('admin.historial.edit',$row->id)}}" class="btn btn-warning btn-sm"> <i class="icon-book-open fa-2x"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>