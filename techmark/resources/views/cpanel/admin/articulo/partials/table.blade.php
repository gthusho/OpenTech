<table class="table table-striped">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE</th>
        <th>CODIGO</th>
        <th>CATEGORIA</th>
        <th>MARCA</th>
        <th>MATERIAL</th>
        <th>MEDIDA</th>
        <th>COSTO</th>
        <th>PRECIO #1</th>
        <th>PRECIO #2</th>
        <th>PRECIO #3</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($articulos as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{$row->nombre}}</td>
            <td>{{$row->codigo}}</td>
            <td>{{$row->categoria->nombre}}</td>
            <td>{{$row->marca->nombre}}</td>
            <td>{{$row->material->nombre}}</td>
            <td>{{$row->medida->nombre}}</td>
            <td>{{$row->costo}}</td>
            <td>{{$row->precio1}}</td>
            <td>{{$row->precio2}}</td>
            <td>{{$row->precio3}}</td>
            <td>
                <a href="{{route('admin.articulo.edit',$row->id)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>