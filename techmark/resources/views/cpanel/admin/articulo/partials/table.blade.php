<table class="table table-striped">
    <thead>
    <tr>
        <th>CODIGO</th>
        <th>NOMBRE</th>
        <th>CATEGORIA</th>
        <th>MARCA</th>
        <th>MATERIAL</th>
        <th>UNIDAD</th>
        <th>COSTO</th>
        <th>PRECIO #1</th>
        <th>PRECIO #2</th>
        <th>PRECIO #3</th>
        <th>PRECIO #4</th>
        <th>PRECIO #5</th>

        <th class="text-center">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($articulos as $row)
        <tr>
            <td class="text-center"><strong>{{$row->codigo}}</strong> <br><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{$row->nombre}}</td>
            <td>{{$row->categoria->nombre}}</td>
            <td>{{$row->marca->nombre}}</td>
            <td>{{$row->material->nombre}}</td>
            <td>{{$row->medida->nombre}}</td>
            <td>{{\App\Tool::convertMoney($row->costo)}}</td>
            <td>{{\App\Tool::convertMoney($row->precio1)}}</td>
            <td>{{\App\Tool::convertMoney($row->precio2)}}</td>
            <td>{{\App\Tool::convertMoney($row->precio3)}}</td>
            <td>{{\App\Tool::convertMoney($row->precio4)}}</td>
            <td>{{\App\Tool::convertMoney($row->precio5)}}</td>
            <td class="text-center">
                <a href="{{route('admin.articulo.edit',$row->id)}}" class="btn btn-primary btn-sm"> <i class=" icon-pencil fa-2x"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>