<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">Navegacion</li>
                <li class="has_sub">
                    <a href="{{url('dashboard')}}" class="waves-effect"><i class="ti-home"></i> <span> Inicio </span> </a>
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