<style>
    h3 {text-align: center}
    th {text-align: center}
</style>
<br>
@if($historial->ventaarticulo->count() > 0)
    <h3>VENTAS ARTICULOS</h3>
    <table cellspacing="5">
        @include('cpanel.report.historial.partials.infVentaArt')
    </table>
@endif
@if($historial->ventaproducto->count() > 0)
    <h3>VENTAS PRODUCTOS</h3>
    <table cellspacing="5">
        @include('cpanel.report.historial.partials.infVentaProd')
    </table>
@endif
@if($historial->cotizacionarticulo->count() > 0)
    <h3>COTIZACIONES ARTICULOS</h3>
    <table cellspacing="5">
        @include('cpanel.report.historial.partials.infCotizacionArt')
    </table>
@endif
@if($historial->cotizacionproducto->count() > 0)
    <h3>COTIZACIONES PRODUCTOS</h3>
    <table cellspacing="5">
        @include('cpanel.report.historial.partials.infCotizacionProd')
    </table>
@endif
@if($historial->produccion->count() > 0)
    <h3>PRODUCCIONES REALIZADAS</h3>
    <table cellspacing="5">
        @include('cpanel.report.historial.partials.infProducciones')
    </table>
@endif
@if($historial->visita->count() > 0)
    <h3>VISITAS REALIZADAS</h3>
    <table cellspacing="5">
        @include('cpanel.report.historial.partials.infVisitas')
    </table>
@endif