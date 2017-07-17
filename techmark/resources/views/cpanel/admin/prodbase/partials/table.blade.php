<table class="table table-hover  m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>DESCRIPCION</th>
        <th>MATERIALES</th>
        <th>ULTIMO USUARIO</th>
        <th class="text-center">ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productos as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td>{{($row->descripcion)}}</td>
            <td>
                @foreach($row->detprodbase->unique('material_id') as $prod)
                    {{$prod->material->nombre}}
                    <br>
                @endforeach
            </td>
            <td>{{($row->usuario->nombre)}}</td>
            <td class="text-center">
                <a href="{{route('admin.prodbase.edit',$row->id)}}" class="btn btn-primary btn-sm"><i class=" icon-pencil fa-2x"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>