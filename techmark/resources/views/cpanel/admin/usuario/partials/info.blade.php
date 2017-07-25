<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">Usuario: {{$user->nombre}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tr>
                <td><span class="text-custom">Nombre Usuario </span></td>
                <td>{{$user->username}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Rol </span></td>
                <td>{{$user->rol->nombre}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Telefono/Celular </span></td>
                <td>{{$user->telefono}}
                <br> {{$user->celular}}
                </td>
            </tr>
            <tr>
                <td><span class="text-custom">Direccion </span></td>
                <td>{{$user->direccion}}</td>
            </tr>
        </table>
    </div>
</div>
