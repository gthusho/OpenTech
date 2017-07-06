{{-- solo necesitas usar esto diego  --}}
{{--
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
--}}
<li class="has_sub">
    <a href="javascript:void(0);" class="waves-effect"><i class="icon-credit-card"></i><span class="label label-primary pull-right">2</span> <span> Ventas </span>  </a>
    <ul class="list-unstyled">
        <li><a href="{{route('admin.venta_art.index')}}">Ventas Articulos</a></li>
        <li><a href="{{url('dashboard')}}">Ventas Productos</a></li>
    </ul>
</li>