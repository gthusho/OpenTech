<table class="table table-hover  m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>IMAGEN</th>
        <th>PRODUCTO</th>
        <th>TALLA</th>
        <th>PRECIO 1</th>
        <th>PRECIO 2</th>
        <th>PRECIO 3</th>
        <th>PRECIO 4</th>
        <th>PRECIO 5</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productos as $row)
        <tr>
            <td><img src="{{$row->producto->getImagen()}}" class="img-thumbnail thumb-sm"></td>
            <td>{{$row->producto->descripcion}}</td>
            <td>{{$row->talla->nombre}}</td>
            <td>{{\App\Tool::convertMoney($row->precio1)}}</td>
            <td>{{\App\Tool::convertMoney($row->precio2)}}</td>
            <td>{{\App\Tool::convertMoney($row->precio3)}}</td>
            <td>{{\App\Tool::convertMoney($row->precio4)}}</td>
            <td>{{\App\Tool::convertMoney($row->precio5)}}</td>
            <td>
                <a href="{{route('admin.producto.asignacion.talla.edit',$row->id)}}"><i class=" icon-pencil"></i> Editar</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>