<table class="table table-hover table-bordered ">
    <thead>
    <tr>
        <th>SUCURSAL</th>
        <th>NOMBRE PRODUCTO</th>
        <th class="text-right">CODIGO</th>
        <th>TALLAS</th>
        <th>STOCK</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productos as $row)
        <tr>
            <td class="bg-inverse text-white">{{$row->sucursal->nombre}}</td>
            <td>{{$row->producto->descripcion}}</td>
            <td class="text-right">{{$row->producto->codigo}}</td>
            <td>{{$row->talla->nombre}}</td>
            <td class="bg-primary text-white text-right">{{$row->cantidad}}</td>
    @endforeach
    </tbody>
</table>