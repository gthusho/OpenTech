<table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE</th>
        <th>REGISTRO</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tipoarticulos as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>

            <td>{{($row->Descripcion)}}</td>
            <td>{{($row->registro)}}</td>
            <td>
                <a href="{{route('admin.tipoarticulo.edit',$row->IdTipoArticulo)}}"> <i class="icon-pencil"> Editar </i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>