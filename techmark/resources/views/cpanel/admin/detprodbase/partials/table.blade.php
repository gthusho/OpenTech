<table class="table table-striped">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE</th>
        <th>MATERIALES</th>
        <th>TALLAS</th>
        <th>PRECIO</th>
        <th>COSTO</th>
        <th>ULTIMO USUARIO</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($detalles as $row)
        <tr>
            <td><span class="label label-{{\App\Tool::activo($row->prodbase->estado)[0]}}">{{\App\Tool::activo($row->prodbase->estado)[1]}}</span></td>
            <td>{{$row->prodbase->descripcion}}</td>
            <td>{{$row->material->nombre}}</td>
            <td>{{$row->talla->nombre}}</td>
            <td>{{\App\Tool::convertMoney($row->precio)}}</td>
            <td>{{\App\Tool::convertMoney($row->costo)}}</td>
            <td>{{$row->usuario->nombre}}</td>
            <td>
                <a href="{{route('admin.detprodbase.edit',$row->id)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>