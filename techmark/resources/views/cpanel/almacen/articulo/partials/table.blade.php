<table class="table table-striped">
    <thead>
    <tr>
        <th>DESCRIPCION</th>
        <th>FAMILIA</th>
        <th>MEDIDA</th>
        <th>MARCA</th>
        <th>TIPO ARTICULO</th>
        <th>USUARIO</th>
        <th>CODIGO</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($articulos as $row)
        <tr>
            <td>{{$row->Descripcion}}</td>
            <td>{{$row->familia->Descripcion}}</td>
            <td>{{$row->medida->Descripcion}}</td>
            <td>{{$row->marca->Descripcion}}</td>
            <td>{{$row->tipoarticulo->Descripcion}}</td>
            <td>{{$row->usuario->Nombre}}</td>
            <td>{{$row->Codigo}}</td>
            <td>
                <a href="{{route('admin.articulo.edit',$row->IdArticulo)}}"><i class="icon-pencil"> Editar </i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>