<table class="table table-hover  m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE</th>
        <th>REGISTRADO</th>
        <th>EDITADO</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($medidas as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{($row->nombre)}}</td>
            <td>{{($row->registro)}}</td>
            <td>{{($row->updated_at)}}</td>
            <td>
                <a href="{{route('admin.medida.edit',$row->id)}}"><i class=" icon-pencil"></i> Editar</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>