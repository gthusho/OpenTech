<table class="table table-hover">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE Y DIRECCION</th>
        <th>CIUDAD</th>
        <th>REGISTRO</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($almacenes as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>
                {{($row->nombre)}}
                <br><b class="text-primary">{{$row->direccion}}</b>
            </td>
            <td>{{($row->ciudad->nombre)}}</td>
            <td>{{$row->registro}}</td>
            <td>
                <a href="{{route('admin.almacen.edit',$row->id)}}"> <i class="icon-pencil"></i> Editar </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>