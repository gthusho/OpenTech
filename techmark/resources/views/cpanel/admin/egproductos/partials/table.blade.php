<table class="table  m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>VENTA</th>
        <th>FECHA</th>
        <th>PRODUCTO</th>
        <th>TALLA</th>
        <th class="bg-primary text-white">CANTIDAD</th>
        <th>SUCURSAL</th>
    </tr>
    </thead>
    <tbody>
    @foreach($egresos as $row)
        <tr>
            <td>{{$row->ventaproducto->getCode()}}</td>
            <td>{{date('d/m/Y',strtotime($row->registro))}}</td>
            <td>{{$row->producto->descripcion}}</td>
            <td>{{$row->talla->nombre}}</td>
            <td class="bg-primary text-white">{{$row->cantidad}}</td>
            <td>{{$row->sucursal->nombre}}</td>
        </tr>
    @endforeach
    </tbody>
</table>