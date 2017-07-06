<table class="table table-hover  m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE SUCURSAL</th>
        <th>CIUDAD</th>
        <th>TELEFONO / CELULAR</th>
        <th>DIRECCION</th>
        <th>ALMACEN </th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sucursales as $row)
        <tr>
            <td><span class="label label-{{\App\Tool::activo($row->estado)[0]}}">{{\App\Tool::activo($row->estado)[1]}}</span></td>
            <td >
                {{($row->nombre)}}
                <br>
                <span class="text-primary">NIT: {{($row->nit)}}</span>
            </td>
            <td>
                {{$row->ciudad->nombre}}

            </td>
            <td>
                <i class=" icon-phone"></i> {{$row->telefono}}
                <br>
                <i class=" icon-screen-smartphone"></i> {{$row->celular}}
            </td>
            <td>{{$row->direccion}}</td>
            <td>
                {{$row->almacen->nombre}}
                <br>
                {{$row->almacen->direccion}}
            </td>
            <td>
                <a href="{{route('admin.sucursal.edit',$row->id)}}"><i class=" icon-pencil"></i> Editar</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>