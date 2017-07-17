<table class="table table-hover">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>SUCURSAL</th>
        <th>NOMBRE ALMACEN</th>
        <th>DIRECCION</th>
        <th>CIUDAD</th>
        <th class="text-center">ACCIONES</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($almacenes as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{$row->sucursal->nombre}}</td>
            <td>{{($row->nombre)}}</td>
            <td>{{($row->direccion)}}</td>
            <td>{{($row->ciudad->nombre)}}</td>
            <td class="text-center" >
                <a href="{{route('admin.almacen.edit',$row->id)}}" class="btn btn-primary btn-sm"> <i class="icon-pencil fa-2x"></i>  </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>