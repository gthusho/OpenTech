<table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE USUARIO</th>
        <th>ROL</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{($row->NombreUsuario)}}</td>
            <td>{{$row->rol->Descripcion}}</td>
            <td>
                <a href="{{route('admin.usuario.edit',$row->IdUsuario)}}"><i class=" icon-pencil"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>