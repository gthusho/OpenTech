<table class="table table-striped">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE</th>
        <th>CODIGO</th>
        <th>CATEGORIA</th>
        <th>MARCA</th>
        <th>MATERIAL</th>
        <th>UNIDAD</th>
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
            <td>{{\App\Tool::convertMoney($row->costo)}}</td>
            <td>{{\App\Tool::convertMoney($row->precio1)}}</td>
            <td>{{\App\Tool::convertMoney($row->precio2)}}</td>
            <td>{{\App\Tool::convertMoney($row->precio3)}}</td>
            <td>
                <a href="{{route('admin.articulo.edit',$row->id)}}"> <i class=" icon-pencil"></i> Editar </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>