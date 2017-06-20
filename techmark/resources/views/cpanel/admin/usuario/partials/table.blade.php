<table class="table table-hover  m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE USUARIO</th>
        <th>ROL</th>
        <th>NOMBRE COMPLETO</th>
        <th>TELEFONO / CELULAR</th>
        <th>DIRECCION</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td >
                {{($row->username)}}
            </td>
            <td>{{$row->rol->nombre}}</td>
            <td>{{$row->nombre}}</td>
            <td>
                <i class=" icon-phone"></i> {{$row->telefono}}
                <br>
                <i class=" icon-screen-smartphone"></i> {{$row->celular}}
            </td>
            <td>{{$row->direccion}}</td>
            <td>
                <a href="{{route('admin.usuario.edit',$row->id)}}"><i class=" icon-pencil"></i> Editar</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>