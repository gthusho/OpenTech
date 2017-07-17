<table class="table table-hover">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE</th>
        <th>DEPARTAMENTO</th>
        <th class="text-center">ACCIONES</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($ciudades as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{($row->nombre)}}</td>
            <td>{{$row->departamento}}</td>
            <td class="text-center">
        
                <a href="{{route('admin.ciudad.edit',$row->id)}}" class="btn btn-primary btn-sm"> <i class="icon-pencil fa-2x"></i>  </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>