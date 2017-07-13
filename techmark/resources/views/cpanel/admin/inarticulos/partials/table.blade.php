<table class="table  m-0 table table-actions-bar">
    <thead>
    <tr>
        <th>COMPRA</th>
        <th>FECHA</th>
        <th>ARTICULO</th>
        <th>CATEGORIA</th>
        <th>MARCA</th>
        <th>MATERIAL</th>
        <th class="bg-primary text-white">CANTIDAD</th>
        <th  class="bg-primary text-white">UNIDAD</th>
        <th>SUCURSAL</th>
        <th>ALMACEN</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ingresos as $row)
        <tr>
            <td>{{$row->compra->getCode()}}</td>
            <td>{{date('d/m/Y',strtotime($row->compra->fecha))}}</td>
            <td>{{$row->articulo->nombre}}</td>
            <td>{{$row->articulo->categoria->nombre}}</td>
            <td>{{$row->articulo->marca->nombre}}</td>
            <td>{{$row->articulo->material->nombre}}</td>
            <td class="bg-primary text-white">{{$row->cantidad}}</td>
            <td class="bg-primary text-white">{{$row->articulo->medida->nombre}}</td>
            <td>{{$row->sucursal->nombre}}</td>
            <td>{{$row->almacen->nombre}}</td>
        </tr>
    @endforeach
    </tbody>
</table>