<table class="table table-hover  m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>CLIENTE</th>
        <th>FECHA</th>
        <th>DIRECCION</th>
        <th>PRODUCTOS</th>
        <th class="text-center">ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($visitas as $row)
        <tr>
            <td>
                {{($row->cliente->razon_social)}}
            </td>
            <td>
                {{date('d/m/Y',strtotime($row->fecha)) .' '. $row->hora}}
            </td>
            <td>
                {{$row->direccion}}
                @if($row->barrio != null || $row->barrio != '')
                    <br><b class="text-primary">BARRIO: </b>{{$row->barrio}}
                @endif
                @if($row->zona != null || $row->zona != '')
                    <br><b class="text-primary">ZONA:</b> {{$row->zona}}
                @endif
            </td>
            <td >
                <table class="table table-hover">
                    <thead>
                    <tr class="bg-custom ">
                        <th class="text-white">MEDIDOS</th>
                        <th class="text-white">PRODUCIDOS</th>
                        <th class="text-white">TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$row->cantMedidos()}}</td>
                            <td>{{$row->cantProducidos()}}</td>
                            <td>{{$row->cantMedidos() + $row->cantProducidos()}}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td class="text-center">
                <a href="{{route('admin.visita.edit',$row->id)}}" class="btn btn-primary btn-sm"><i class=" icon-pencil fa-2x"></i> Tomar Medidas</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>