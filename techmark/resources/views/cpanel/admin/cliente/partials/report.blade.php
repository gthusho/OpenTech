
<div class="btn-group pull-left m-t-15">
    <a href="{{route('admin.cliente.create')}}" class="btn btn-primary  waves-effect waves-light" >Agregar <span class="m-l-5"><i class="fa fa-user-plus"></i></span></a>
</div>
<div class="btn-group pull-right m-t-15">
    <a href="{{url('reportes/clientes').\App\Tool::getDataReportQuery()}}" class="btn btn-inverse  waves-effect waves-light" target="_blank" >Imprimir <span class="m-l-5"><i class=" icon-printer"></i></span></a>
</div>
<div class="btn-group pull-right m-t-15 m-r-5">
    <a href="{{url('reportes/clientes/excel').\App\Tool::getDataReportQuery()}}" class="btn btn-default  waves-effect waves-light" target="_parent">Exportar <span class="m-l-5"><i class="fa fa-file-excel-o"></i></span></a>
</div>