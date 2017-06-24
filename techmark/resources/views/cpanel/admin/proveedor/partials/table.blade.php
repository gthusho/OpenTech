<table class="table table-hover">
    <thead>
    <tr>
        <th>NOMBRE Y/O RAZON SOCIAL</th>
        <th>TELEFONO</th>
        <th>CELULAR</th>
        <th>EMAIL</th>
        <th>FAX</th>
        <th>DIRECCION</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($proveedores as $row)
        <tr>
            <td>
                {{($row->razon_social)}}
                <br><b class="text-primary">NIT: {{$row->nit}}</b>
            </td>
            <td>{{($row->telefono)}}</td>
            <td>{{($row->celular)}}</td>
            <td>{{$row->email}}</td>
            <td>{{($row->fax)}}</td>
            <td>{{($row->direccion)}}</td>
            <td>
        
                <a href="{{route('admin.proveedor.edit',$row->id)}}"> <i class="icon-pencil"></i> Editar </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>