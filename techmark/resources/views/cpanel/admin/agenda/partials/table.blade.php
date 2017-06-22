<table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>CATEGORIA</th>
        <th width="30%">ASUNTO</th>
        <th>MENSAJE</th>
        <th>CONTACTO/UBICACION</th>
        <th>REGISTRO</th>
        <th>ACCION</th>
    </tr>
    </thead>
    <tbody>
    @foreach($actividades as $row)
        <tr>
            <td><span class="label label-{{(Config::get('gthusho.colores_categorias_agenda')[$row->categoria])}}">{{$row->categoria}}</span></td>
            <td>
                <b><span>{{$row->fecha}}</span></b><br>
                <h4>{{$row->asunto}}</h4>
            </td>
            <td>

                {!! $row->descripcion !!}


            </td>
            <td>
                {{$row->planificado_con}} <br>
                <b>{{$row->ubicacion}}</b>
            </td>
            <td >
                {{$row->usuario->nombre}}
                <br>
                <b>{{$row->usuario->rol->descripcion}}</b>

            </td>

            <td>

                <a href="{{route('admin.agenda.edit',$row->id)}}" class="table-action-btn"> <i class="md md-edit"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>