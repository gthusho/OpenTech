<div class="table-rep-plugin">
    <div class="table-responsive" data-pattern="priority-columns">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>ARTICULO</th>
                <th>CATEGORIA</th>
                <th>MARCA</th>
                <th>MATERIAL</th>
                <th>CANTIDAD</th>
                <th>UNIDAD</th>
                <th>COSTO</th>
                <th>TOTAL</th>
            </tr>
            </thead>

            <tbody>
            @if(Session::has('cart'))
                <?php $i=1; ?>
                @foreach($articulos as $articulo)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            {{$articulo['item']['nombre']}}
                        </td>
                        <td>
                            {{\App\ToolArticuloCart::getNombreById($articulo['item']['categoria_articulo_id'],'categoria')}}
                        </td>
                        <td>
                            {{\App\ToolArticuloCart::getNombreById($articulo['item']['marca_id'],"marca")}}
                        </td>
                        <td> {{\App\ToolArticuloCart::getNombreById($articulo['item']['material_id'],"material")}}</td>
                        <td>{{$articulo['qty']}}</td>
                        <td>{{\App\ToolArticuloCart::getNombreById($articulo['item']['medida_id'],"unidad")}}</td>
                        <td>
                            {{\App\Tool::convertMoney($articulo['price'])}}
                        </td>
                        <td>
                            {{\App\Tool::convertMoney(($articulo['qty']*$articulo['price']))}}
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

</div>
