<div class="btn-group pull-right m-t-15">
    <button onclick="printJS('{{url('reportes/egresosa').\App\Tool::getDataReportQuery()}}')" class="btn btn-inverse  waves-effect waves-light">Imprimir <span class="m-l-5"><i class=" icon-printer"></i></span></button>
</div>
<div class="btn-group pull-right m-t-15 m-r-5">
    <a href="{{url('reportes/egresosa/excel').\App\Tool::getDataReportQuery()}}" class="btn btn-default  waves-effect waves-light" target="_parent">Exportar <span class="m-l-5"><i class="fa fa-file-excel-o"></i></span></a>
</div>