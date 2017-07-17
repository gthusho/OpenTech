<table class="table table-hover">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>NOMBRE Y CI</th>
        <th>SUCURSAL</th>
        <th>DIRECCION</th>
        <th>TELEFONO</th>
        <th>EMAIL</th>
        <th>REFERENCIA</th>
        <th>FECHA DE INGRESO</th>
        <th class="text-center">ACCIONES</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($trabajadores as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>

            <td>
                {{($row->nombre)}}
                <br><b class="text-primary">CI:{{$row->ci}}</b>
            </td>
            <td>
                {{($row->sucursal->nombre)}}
                <br><b class="text-primary">Cargo:{{$row->cargo}}</b>
            </td>
            <td>{{($row->direccion)}}</td>
            <td>{{$row->telefono}}</td>
            <td>{{$row->email}}</td>
            <td>
                {{($row->referencia)}}
                <br><b class="text-primary">Tel:{{$row->tel_referencia}}</b>
            </td>
            <td>{{$row->fecha_ingreso}}</td>
            <td class="text-center">
                <a href="{{route('admin.trabajador.edit',$row->id)}}" class="btn btn-primary btn-sm"> <i class="icon-pencil fa-2x"></i>  </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>