<table class="table table-hover  m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>ESTADO</th>
        <th>IMAGEN</th>
        <th>DESCRIPCION</th>
        <th>TALLAS</th>
        <th class="text-center">ACCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productos as $row)
        <tr>
            <td><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>

            <td>
                <img src="{{$row->getImagen()}}"   class="img-thumbnail thumb-lg">
            </td>
            <td >{{($row->descripcion)}}
                <br><b>Codigo:</b> {{($row->codigo)}}
                <br> <b>Codigo Barras:</b>{{($row->codigobarra)}}
            </td>
            <td >
                @if($row->tallas->count()>0)
                    <table class="table table-hover">
                        <thead>
                        <tr class="bg-custom ">
                            <th class="text-white">TALLA</th>
                            <th class="text-white">PRECIO 1</th>
                            <th class="text-white">PRECIO 2</th>
                            <th class="text-white">PRECIO 3</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($row->tallas as $fila)
                            <tr>
                                <td>{{$fila->talla->nombre}}</td>
                                <td>{{\App\Tool::convertMoney($fila->precio1)}}</td>
                                <td>{{\App\Tool::convertMoney($fila->precio2)}}</td>
                                <td>{{\App\Tool::convertMoney($fila->precio3)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <a href="{{route('admin.producto.asignacion.talla.create',['id'=>$row->id,'producto'=>\App\Tool::slug($row->descripcion,false)])}}">Asignar Tallas</a>
                @endif

            </td>
            <td class="text-center">
                <a href="{{route('admin.producto.edit',$row->id)}}" class="btn btn-primary btn-sm"><i class=" icon-pencil fa-2x"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>