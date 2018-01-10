<style type="text/css">
    h3 {text-align: center}
    td {text-align: center}
    th {text-align: center}
</style>
<div class="row">
    <h3 class="text-custom">HISTORIAL DE {{strtoupper($historial->razon_social)}}</h3>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15">
            <button onclick="printJS('{{url('reportes/historial').\App\Tool::getDataReportQuery().'?id='.$historial->id}}')" class="btn btn-inverse  waves-effect waves-light">Imprimir <span class="m-l-5"><i class=" icon-printer"></i></span></button>
        </div>
        <div class="btn-group pull-right m-t-15 m-r-5">
            <a href="{{url('reportes/historial/excel').\App\Tool::getDataReportQuery().'?id='.$historial->id}}" class="btn btn-default  waves-effect waves-light" target="_parent">Exportar <span class="m-l-5"><i class="fa fa-file-excel-o"></i></span></a>
        </div>
    </div>
</div>
<br>
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