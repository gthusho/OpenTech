<table class="table table-striped">
    <thead>
    <tr>
        <th>DESCRIPCION</th>
        <th>DIRECCION</th>
        <th>USUARIO</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($almacenes as $row)
        <tr>
            <td>{{$row->Descripcion}}</td>
            <td>{{$row->Direccion}}</td>
            <td>{{$row->usuario->Nombre}}</td>
            <td>
                <a href="{{route('admin.almacen.edit',$row->IdAlmacen)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>