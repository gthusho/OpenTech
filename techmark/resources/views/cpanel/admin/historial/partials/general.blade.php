<style type="text/css">
    h3 {text-align: center}
    td {text-align: center}
    th {text-align: center}
</style>
<div class="row">
    <h3 class="text-custom">HISTORIAL DE {{strtoupper($historial->razon_social)}}</h3>
</div>
<div class="row">
    <div class="col-lg-6">
        @include('cpanel.admin.historial.partials.infArticulos')
    </div>
    <div class="col-lg-6">
        @include('cpanel.admin.historial.partials.infProductos')
    </div>
    <div class="col-lg-6">
        <div class="panel panel-border panel-custom">
            <div class="panel-heading">
                <h3 class="panel-title">RESULTADOS</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                        <td><span class="text-custom">Cantidad vendidos: </span></td>
                        <td>{{$historial->cantVenArt() + $historial->cantVenPrd()}}</td>
                    </tr>
                    <tr>
                        <td><span class="text-custom">Cantidad cotizados: </span></td>
                        <td>{{$historial->cantCotArt() + $historial->cantCotPrd()}}</td>
                    </tr>
                    <tr>
                        <td class="bg-inverse"><span class="text-white">CANTIDAD TOTAL: </span></td>
                        <td class="bg-inverse"><span class="text-white">{{$historial->cantCotArt() + $historial->cantCotPrd() + $historial->cantVenArt() + $historial->cantVenPrd()}}</span></td>
                    </tr>
                    <tr>
                        <td><span class="text-custom">Dinero recaudado: </span></td>
                        <td>{{\App\Tool::convertMoney($historial->totReal())}}</td>
                    </tr>
                    <tr>
                        <td><span class="text-custom">Dinero cotizado: </span></td>
                        <td>{{\App\Tool::convertMoney($historial->totImg())}}</td>
                    </tr>
                    <tr>
                        <td class="bg-inverse"><span class="text-white">DINERO TOTAL: </span></td>
                        <td class="bg-inverse"><span class="text-white">{{\App\Tool::convertMoney($historial->totReal() + $historial->totImg())}}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>