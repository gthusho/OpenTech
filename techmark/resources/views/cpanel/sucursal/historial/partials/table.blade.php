<table class="table table-hover">
    <thead>
    <tr>
        <th>NOMBRE Y/O RAZON SOCIAL</th>
        <th>TOTAL VENTAS ARTICULOS</th>
        <th>TOTAL VENTAS PRODUCTOS</th>
        <th>TOTAL COTIZACIONES ARTICULOS</th>
        <th>TOTAL COTIZACIONES PRODUCTOS</th>
        <th>TOTAL PRODUCCIONES</th>
        <th>TOTAL MEDICIONES</th>
        <th class="text-center" colspan="2">DETALLE</th>
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
                            <th class="text-white">CANT</th>
                            <th class="text-white">Bs</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$row->cantVenArt()}} unid</td>
                            <td>{{\App\Tool::convertMoney($row->totVenArt())}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table class="table table-hover">
                        <thead>
                        <tr class="bg-custom ">
                            <th class="text-white">CANT.</th>
                            <th class="text-white">Bs</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
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
                            <th class="text-white">CANT.</th>
                            <th class="text-white">Bs</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
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
                            <th class="text-white">CANT.</th>
                            <th class="text-white">Bs</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
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
                            <th class="text-white">CANT.</th>
                            <th class="text-white">Bs</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
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
                            <th class="text-white">VISITAS</th>
                            <th class="text-white">MED</th>
                            <th class="text-white">PROD</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$row->cantVis()}}</td>
                            <td>{{$row->cantMed()}}</td>
                            <td>{{$row->cantPrd()}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <a href="{{route('s.historial.edit',$row->id)}}" class="btn btn-primary btn-sm"> <i class="icon-book-open fa-2x"></i></a>
                </td>
                <td>
                    <button onclick="printJS('{{url('reportes/historial').'?id='.$row->id}}')"
                            href="{{url('reportes/historial').'?id='.$row->id}}"
                            class="btn btn-primary  btn-sm" >
                        <i class=" icon-printer fa-2x"></i></button>
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>