<table class="table table-hover  m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>DESCRIPCION</th>
        <th>IMAGEN</th>
        <th>FECHA</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productos as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{($row->descripcion)}}</td>
            <td>
                <img src="{{$row->getImagen()}}" alt="{{$row->descripcion}}.jpg" height="100px" width="100px" class="img-thumbnail">
            </td>
            <td>{{$row->fecha}}</td>
            <td>
                <a href="{{route('admin.producto.edit',$row->id)}}"><i class=" icon-pencil"></i> Editar</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>