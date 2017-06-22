<table class="table table-hover">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE</th>
        <th>DEPARTAMENTO</th>
        <th>REGISTRO</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($ciudades as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{($row->nombre)}}</td>
            <td>{{$row->departamento}}</td>
            <td>{{($row->registro)}}</td>
            <td>
        
                <a href="{{route('admin.ciudad.edit',$row->id)}}"> <i class="icon-pencil"></i> Editar </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>