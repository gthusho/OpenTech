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
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-basket"></i><span class="label label-primary pull-right">5</span> <span> Articulos </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.articulo.index')}}">Articulos</a></li>
                        <li><a href="{{route('admin.categoria.index')}}">Categorias Articulos</a></li>
                        <li><a href="{{route('admin.marca.index')}}">Marcas</a></li>
                        <li><a href="{{route('admin.material.index')}}">Materiales</a></li>
                        <li><a href="{{route('admin.unidad.index')}}">Medidas</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-basket-loaded"></i><span class="label label-primary pull-right">4</span> <span> Productos </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.detprodbase.index')}}">Detalle Producto Base</a></li>
                        <li><a href="{{route('admin.prodbase.index')}}">Producto Base</a></li>
                        <li><a href="{{route('admin.producto.index')}}">Producto</a></li>
                        <li><a href="{{route('admin.talla.index')}}">Tallas</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class=" ti-notepad"></i><span class="label label-primary pull-right">6</span> <span> Inventario </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.usuario.index')}}">Articulos</a></li>
                        <li><a href="{{route('admin.usuario.index')}}">Productos</a></li>
                        <li><a href="{{route('ingresos.articulos.index')}}">Ingresos Articulos</a></li>
                        <li><a href="{{route('admin.rol.index')}}">Ingresos Productos</a></li>
                        <li><a href="{{route('egresos.articulos.index')}}">Egresos Articulos</a></li>
                        <li><a href="{{route('admin.rol.index')}}">Egresos Productos</a></li>
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

                <li class="text-muted menu-title">Configuraciones Sistemas</li>
                <li class="has_sub">
                    <a href="{{route('admin.ciudad.index')}}" class="waves-effect"><i class=" icon-location-pin"></i> <span> Ciudades </span> </a>
                </li>
                <li class="text-muted menu-title">Rutas Liss</li>
                @include('theme.ubold.sidebar.liss')
                <li class="text-muted menu-title">Rutas Diego</li>
                @include('theme.ubold.sidebar.diego')
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>