
<div class="btn-group pull-left m-t-15">

    <a href="{{route('admin.articulo.create')}}" class="btn btn-primary  waves-effect waves-light" >Agregar <span class="m-l-5"><i class="fa fa-plus"></i></span></a>
</div>
<div class="btn-group pull-right m-t-15">
    <button onclick="printJS('{{url('reportes/articulos').\App\Tool::getDataReportQuery()}}')" class="btn btn-inverse  waves-effect waves-light">Imprimir <span class="m-l-5"><i class=" icon-printer"></i></span></button>
</div>
<div class="btn-group pull-right m-t-15 m-r-5">
    <a href="{{url('reportes/articulos/excel').\App\Tool::getDataReportQuery()}}" class="btn btn-default  waves-effect waves-light" target="_parent">Exportar <span class="m-l-5"><i class="fa fa-file-excel-o"></i></span></a>
</div>