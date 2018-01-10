<table class="table table-hover">
    <thead>
    <tr>
        <th>NOMBRE Y/O RAZON SOCIAL</th>
        <th>VENTAS ARTICULOS</th>
        <th>VENTAS PRODUCTOS</th>
        <th>COTIZACIONES ARTICULOS</th>
        <th>COTIZACIONES PRODUCTOS</th>
        <th>PRODUCCIONES</th>
        <th>MEDICIONES</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($historial as $row)
        @if($row->nit != 0)
            <tr>
                <td>
                    {{($row->razon_social)}}
                    <br><b class="text-primary">NIT: {{$row->nit}}</b>
                </td>
                <td>
                    <table class="table table-hover">
                        <thead>
                        <tr class="bg-custom ">
                            <th class="text-white">TIPO</th>
                            <th class="text-white">FECHA</th>
                            <th class="text-white">CANT</th>
                            <th class="text-white">PRECIO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($row->ventaarticulo as $fila)
                            @if($fila->estado!='c')
                                <tr>
                                    <td>{{$fila->tipo_pago}}</td>
                                    <td>{{date('d/m/Y',strtotime($fila->registro))}}</td>
                                    <td>{{$fila->totalCantidad()}}</td>
                                    <td>{{\App\Tool::convertMoney($fila->totalPrecio())}}</td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td><i class="ion-arrow-right-a"></i></td>
                            <td><b class="text-inverse">TOTAL:</b></td>
                            <td>{{$row->cantVenArt()}}</td>
                            <td>{{\App\Tool::convertMoney($row->totVenArt())}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table class="table table-hover">
                        <thead>
                        <tr class="bg-custom ">
                            <th class="text-white">TIPO</th>
                            <th class="text-white">FECHA</th>
                            <th class="text-white">CANT</th>
                            <th class="text-white">PRECIO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($row->ventaproducto as $fila)
                            @if($fila->estado!='c')
                                <tr>
                                    <td>{{$fila->tipo_pago}}</td>
                                    <td>{{date('d/m/Y',strtotime($fila->registro))}}</td>
                                    <td>{{$fila->totalCantidad()}}</td>
                                    <td>{{\App\Tool::convertMoney($fila->totalPrecio())}}</td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td><i class="ion-arrow-right-a"></i></td>
                            <td><b class="text-inverse">TOTAL:</b></td>
                            <td>{{$row->cantVenPrd()}}</td>
                            <td>{{\App\Tool::convertMoney($row->totVenPrd())}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table class="table table-hover">
                        <thead>
                        <tr class="bg-custom ">
                            <th class="text-white">FECHA</th>
                            <th class="text-white">CANT</th>
                            <th class="text-white">PRECIO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($row->cotizacionarticulo as $fila)
                            <tr>
                                <td>{{date('d/m/Y',strtotime($fila->registro))}}</td>
                                <td>{{$fila->totalCantidad()}}</td>
                                <td>{{\App\Tool::convertMoney($fila->totalPrecio())}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><b class="text-inverse">TOTAL:</b></td>
                            <td>{{$row->cantCotArt()}}</td>
                            <td>{{\App\Tool::convertMoney($row->totCotArt())}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table class="table table-hover">
                        <thead>
                        <tr class="bg-custom ">
                            <th class="text-white">FECHA</th>
                            <th class="text-white">CANT</th>
                            <th class="text-white">PRECIO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($row->cotizacionproducto as $fila)
                            <tr>
                                <td>{{date('d/m/Y',strtotime($fila->registro))}}</td>
                                <td>{{$fila->totalCantidad()}}</td>
                                <td>{{\App\Tool::convertMoney($fila->totalPrecio())}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><b class="text-inverse">TOTAL:</b></td>
                            <td>{{$row->cantCotPrd()}}</td>
                            <td>{{\App\Tool::convertMoney($row->totCotPrd())}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table class="table table-hover">
                        <thead>
                        <tr class="bg-custom ">
                            <th class="text-white">FECHA</th>
                            <th class="text-white">CANT</th>
                            <th class="text-white">PRECIO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($row->produccion as $fila)
                            <tr>
                                @if($fila->entrega != null)
                                    <td>{{date('d/m/Y',strtotime($fila->fin))}}</td>
                                @else
                                    <td>{{date('d/m/Y',strtotime($fila->entrega))}}</td>
                                @endif
                                    <td>{{$fila->totalCantidad()}}</td>
                                    <td>{{\App\Tool::convertMoney($fila->precio)}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><b class="text-inverse">TOTAL:</b></td>
                            <td>{{$row->cantProd()}}</td>
                            <td>{{\App\Tool::convertMoney($row->totProd())}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table class="table table-hover">
                        <thead>
                        <tr class="bg-custom ">
                            <th class="text-white">FECHA</th>
                            <th class="text-white">MED</th>
                            <th class="text-white">PROD</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($row->visita as $fila)
                            <tr>
                                <td>{{date('d/m/Y',strtotime($fila->fecha))}}</td>
                                <td>{{$fila->cantMedidos()}}</td>
                                <td>{{$fila->cantProducidos()}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><b class="text-inverse">TOTAL:</b></td>
                            <td>{{$row->cantMed()}}</td>
                            <td>{{$row->cantPrd()}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>