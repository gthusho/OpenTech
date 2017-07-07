<!DOCTYPE html>
<html>
<head>
@include('theme.ubold.partials.css')
</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>

<div class="wrapper-page">
    <div class="card-box">
        <div class="panel-heading">
            <h3 class="text-center">Ingresar al  <strong class="text-primary">Sistema</strong></h3>
            <h3 class="text-center"> <strong class="text-primary">JADE V.1.0</strong></h3>
        </div>

       @yield('content')

    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <p>
                OpenRed Bolivia 2017 <a href="#" class="text-primary m-l-5"><b> By Rocket team</b></a>
            </p>
        </div>
    </div>

</div>

<script>
    var resizefunc = [];
</script>

@include('theme.ubold.partials.js')

</body>
</html>