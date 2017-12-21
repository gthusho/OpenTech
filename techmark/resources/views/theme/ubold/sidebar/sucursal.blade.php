<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">Navegacion</li>
                <li class="has_sub">
                    <a href="{{url('dashboard')}}" class="waves-effect"><i class="ti-home"></i> <span> Inicio </span> </a>
                </li>
                <li class="has_sub">
                    <a href="{{route('s.gasto.index')}}" class="waves-effect"><i class=" icon-wallet"></i> <span> Gastos </span> </a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-basket"></i><span class="label label-primary pull-right">4</span> <span> Ventas </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('s.venta_art.index')}}">Venta Articulos</a></li>
                        <li ><a href="{{route('s.ventas.productos.index')}}">Venta Productos</a></li>
                        <li><a href="{{route('s.venta-credito-art.index')}}">Credito Venta Articulos</a></li>
                        <li><a href="{{route('s.ventas.creditos.productos.index')}}">Venta Credito Productos</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class=" icon-handbag"></i><span class="label label-primary pull-right">4</span> <span> Inventario </span>  </a>
                <ul class="list-unstyled">
                    <li class="text-muted menu-title">ARTICULOS</li>
                    <li><a href="{{route('s.inventario.articulos')}}"> Articulos</a></li>
                    <li><a href="{{route('s.ingresos.articulos.index')}}">Ingresos Articulos</a></li>
                    <li><a href="{{route('s.egresos.articulos.index')}}">Egresos Articulos</a></li>
                    <li class="text-muted menu-title">PRODUCTOS</li>
                    <li ><a href="{{route('s.inventario.productos')}}"> Productos</a></li>
                    <li><a href="{{route('s.ingresos.productos.index')}}">Ingresos Productos</a></li>
                    <li><a href="{{route('s.egresos.productos.index')}}">Egresos Productos</a></li>
                </ul>
                </li>
                <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect"><i class=" icon-note"></i><span class="label label-primary pull-right">2</span> <span> Cotizaciones </span>  </a>
                <ul class="list-unstyled">
                    <li ><a href="{{route('s.cotizacion.index')}}"> Articulos</a></li>
                    <li ><a href="{{route('s.cot_producto.index')}}"> Productos</a></li>
                </ul>
                </li>
                <li class="has_sub">
                    <a href="{{route('s.medida.index')}}" class="waves-effect"><i class=" icon-folder-alt"></i> <span> Tomar Medidas </span> </a>
                </li>
                <li class="has_sub">
                    <a href="{{route('s.cliente.index')}}" class="waves-effect"><i class="icon-people"></i> <span> Cliente </span> </a>
                </li>



            </ul>

        </div>
        <div class="clearfix"></div>
    </div>
</div>