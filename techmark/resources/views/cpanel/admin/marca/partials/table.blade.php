<table class="table table-hover  m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE</th>
        <th>DESCRIPCION</th>
        <th class="text-center">ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($marcas as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{($row->nombre)}}</td>
            <td>{{($row->descripcion)}}</td>
            <td class="text-center">
                <a href="{{route('admin.marca.edit',$row->id)}}" class="btn btn-primary btn-sm"><i class=" icon-pencil fa-2x"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>