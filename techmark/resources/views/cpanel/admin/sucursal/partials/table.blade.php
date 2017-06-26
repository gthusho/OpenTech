<table class="table table-hover  m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE SUCURSAL</th>
        <th>CIUDAD</th>
        <th>TELEFONO / CELULAR</th>
        <th>DIRECCION</th>
        <th>ALMACENES ASIGNADOS</th>
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
                <ul class="list-unstyled">
                @foreach($row->depositos as $data)
                    <li><h5 class="text-dark">{{$data->almacen->nombre}}</h5></li>
                @endforeach
                </ul>
            </td>
            <td>
                <a href="{{route('admin.sucursal.edit',$row->id)}}"><i class=" icon-pencil"></i> Editar</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>