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
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-people"></i><span class="label label-primary pull-right">2</span> <span> Usuarios & Roles </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.usuario.index')}}">Usuarios</a></li>
                        <li><a href="{{route('admin.rol.index')}}">Rol</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="{{route('admin.sucursal.index')}}" class="waves-effect"><i class=" ti-direction"></i> <span> Sucursales </span> </a>

                </li>
                @include('theme.ubold.sidebar.liss')
                @include('theme.ubold.sidebar.diego')
                {{--
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-basket"></i><span class="label label-primary pull-right">7</span> <span> Almacen </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.almacen.index')}}">Almacenes</a></li>
                        <li><a href="{{route('admin.articulo.index')}}">Articulos</a></li>
                        <li><a href="{{route('admin.egreso.index')}}">Egresos</a></li>
                        <li><a href="{{route('admin.familia.index')}}">Familias</a></li>
                        <li><a href="{{route('admin.ingreso.index')}}">Ingresos</a></li>
                        <li><a href="{{route('admin.marca.index')}}">Marcas</a></li>
                        <li><a href="{{route('admin.medida.index')}}">Medidas</a></li>
                        <li><a href="{{route('admin.stock.index')}}">Stock</a></li>
                        <li><a href="{{route('admin.tipoarticulo.index')}}">Tipo Articulo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-people"></i><span class="label label-primary pull-right">2</span> <span> Proveedores </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.proveedor.index')}}">Proveedores</a></li>
                    </ul>
                </li>
                
                 <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-people"></i><span class="label label-primary pull-right">2</span> <span> Clientes & Visitas</span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.cliente.index')}}">Clientes</a></li>
                        <li><a href="{{route('admin.visita.index')}}">Visitas</a></li>
                    </ul>
                </li>
--}}
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>