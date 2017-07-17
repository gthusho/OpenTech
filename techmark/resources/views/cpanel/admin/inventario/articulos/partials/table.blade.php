<table class="table table-hover table-bordered ">
    <thead>
    <tr>
        <th>SUCURSAL</th>
        <th>NOMBRE ARTICULO</th>
        <th class="text-right">CODIGO</th>
        <th>CATEGORIA</th>
        <th>MARCA</th>
        <th>MATERIAL</th>
        <th>STOCK</th>
        <th>UNIDAD</th>
    </tr>
    </thead>
    <tbody>
    @foreach($articulos as $row)
        <tr>
            <td class="bg-inverse text-white">{{$row->sucursal->nombre}}</td>
            <td>{{$row->articulo->nombre}}</td>
            <td class="text-right">{{$row->articulo->codigo}}</td>
            <td>{{$row->articulo->categoria->nombre}}</td>
            <td>{{$row->articulo->marca->nombre}}</td>
            <td>{{$row->articulo->material->nombre}}</td>
            <td class="bg-primary text-white text-right">{{$row->cantidad}}</td>
            <td>{{$row->articulo->medida->nombre}}</td>
        </tr>
    @endforeach
    </tbody>
</table>