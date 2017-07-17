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
                    <a href="{{route('admin.agenda.index')}}" class="waves-effect"><i class=" icon-notebook"></i> <span> Agenda </span> </a>

                </li>
                <li class="has_sub">
                    <a href="{{route('admin.caja.index')}}" class="waves-effect"><i class=" typcn typcn-device-desktop"></i> <span> Caja </span> </a>

                </li>
                <li class="has_sub">
                    <a href="{{route('admin.gasto.index')}}" class="waves-effect"><i class=" icon-wallet"></i> <span> Gastos </span> </a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-basket"></i><span class="label label-primary pull-right">1</span> <span> Ventas </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.venta_art.index')}}">Articulos</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class=" icon-note"></i><span class="label label-primary pull-right">2</span> <span> Cotizaciones </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.cotizacion.index')}}">Articulos</a></li>
                        <li><a href="{{route('admin.cot_producto.index')}}">Productos</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class=" icon-handbag"></i><span class="label label-primary pull-right">5</span> <span> Articulos </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.articulo.index')}}">Articulos</a></li>
                        <li><a href="{{route('admin.categoria.index')}}">Categorias Articulos</a></li>
                        <li><a href="{{route('admin.marca.index')}}">Marcas</a></li>
                        <li><a href="{{route('admin.material.index')}}">Materiales</a></li>
                        <li><a href="{{route('admin.unidad.index')}}">Unidades</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class=" icon-puzzle"></i><span class="label label-primary pull-right">4</span> <span> Productos </span>  </a>
                    <ul class="list-unstyled">
                        <li class="text-muted menu-title">PRODUCTOS VENTA</li>
                        <li><a href="{{route('admin.producto.index')}}">Producto</a></li>
                        <li class="text-muted menu-title">PRODUCTOS COTIZACIONES</li>
                        <li><a href="{{route('admin.prodbase.index')}}">Producto Base</a></li>
                        <li><a href="{{route('admin.detprodbase.index')}}">Detallar Producto Base</a></li>
                        <li class="text-muted menu-title">MANTENIMIENTO</li>
                        <li><a href="{{route('admin.talla.index')}}">Tallas</a></li>

                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class=" ti-notepad"></i><span class="label label-primary pull-right">6</span> <span> Inventario </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('inventario.articulos')}}">Articulos</a></li>
                        {{--<li><a href="{{route('admin.usuario.index')}}">Productos</a></li>--}}
                        <li><a href="{{route('ingresos.articulos.index')}}">Ingresos Articulos</a></li>
                        {{--<li><a href="{{route('admin.rol.index')}}">Ingresos Productos</a></li>--}}
                        <li><a href="{{route('egresos.articulos.index')}}">Egresos Articulos</a></li>
                        {{--<li><a href="{{route('admin.rol.index')}}">Egresos Productos</a></li>--}}
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-people"></i><span class="label label-primary pull-right">2</span> <span> Usuarios & Roles </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.usuario.index')}}">Usuarios</a></li>
                        <li><a href="{{route('admin.rol.index')}}">Rol</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="{{route('admin.cliente.index')}}" class="waves-effect"><i class=" icon-user-follow"></i> <span> Clientes </span> </a>
                </li>
                <li class="has_sub">
                    <a href="{{route('admin.trabajador.index')}}" class="waves-effect"><i class=" icon-user-following"></i> <span> Trabajadores </span> </a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-direction"></i><span class="label label-primary pull-right">2</span> <span> Sucursal  & Almacen</span>  </a>
                    <ul class="list-unstyled">
                        <a href="{{route('admin.sucursal.index')}}">Sucursales</a>
                        <a href="{{route('admin.almacen.index')}}">Almacenes</a>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-truck"></i><span class="label label-primary pull-right">2</span> <span> Compras </span>  </a>
                    <ul class="list-unstyled">
                        <a href="{{route('admin.compra.index')}}">Registrar Compra</a>
                        <a href="{{route('admin.compra-credito.index')}}">Compras al Credito</a>
                        <a href="{{route('admin.proveedor.index')}}">Proveedores</a>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="{{route('admin.produccion.index')}}" class="waves-effect"><i class="fa fa-cog fa-spin"></i> <span> Produccion </span> </a>
                </li>
                <li class="text-muted menu-title">Configuraciones Sistemas</li>
                <li class="has_sub">
                    <a href="{{route('admin.ciudad.index')}}" class="waves-effect"><i class=" icon-location-pin"></i> <span> Ciudades </span> </a>
                </li>
                {{--<li class="text-muted menu-title">Rutas Liss</li>--}}
                {{--@include('theme.ubold.sidebar.liss')--}}
                {{--<li class="text-muted menu-title">Rutas Diego</li>--}}
                {{--@include('theme.ubold.sidebar.diego')--}}
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>