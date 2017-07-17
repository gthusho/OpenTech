<style>
    h5{
        margin: 0px 0px 0px 0px;
    }
</style>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">INFORMACION CAJA</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tr>
                <td><span class="text-custom">Fecha Apertura </span></td>
                <td>{{$caja->registro}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Fecha Cierre </span></td>
                <td>{{$caja->fcierre}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Usuario Caja</span></td>
                <td>{{$caja->usuario->nombre}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Sucursal </span></td>
                <td>{{$caja->sucursal->nombre}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Monto de Apertura </span></td>
                <td>{{\App\Tool::convertMoney($caja->apertura)}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Monto Cierre </span></td>
                <td>{{\App\Tool::convertMoney($caja->cierre)}}</td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">OBSERVACIONES</h3>
    </div>
    <div class="panel-body">
        <tr>
            <td>{{$caja->observaciones}}</td>
        </tr>

    </div>
</div>
