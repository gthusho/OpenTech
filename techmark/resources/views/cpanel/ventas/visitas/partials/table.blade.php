<table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>CLIENTE</th>
        <th>FECHA AGENDADA</th>
        <th>UBICACION</th>
        <th>TELEFONO</th>
        <th>USUARIO</th>
        <th>FECHA VISITADA</th>
        <th>ACCIONES</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($visitas as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{($row->cliente->RazonSocial)}}</td>
            <td>{{\App\Tool::fechaCastellano($row->FechaVisitar)}}</td>
            <td>{{($row->Direccion)}}</td>
            <td>{{$row->Telefono}}</td>
            <td>{{($row->usuario->Nombre)}}</td>
            <td>{{$row->fechaV()}}</td>
            <td>
        
                <a href="{{route('admin.visita.edit',$row->IdVisita)}}"><i class="icon-pencil"></i> Editar</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>