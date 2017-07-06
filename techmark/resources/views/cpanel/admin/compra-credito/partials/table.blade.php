<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th>#</th>
                <th>FECHA</th>
                <th>MONTO</th>
                <th>REGISTRO</th>
                <th>ACCION</th>
            </tr>
            </thead>

            <tbody>
                <?php $i=1; ?>
                @foreach($compra->pagos as $row)
                    <tr class="rows" data-id="{{$row->id}}">
                        <td>{{$i++}}</td>
                        <td>
                            {{date('d-m-Y',strtotime($row->fecha))}}
                        </td>
                        <td>
                            {{\App\Tool::convertMoney($row->abono)}}
                        </td>
                        <td>
                            {{$row->usuario->nombre}}
                        </td>
                        <td>
                            {!! Form::open(['route'=>['admin.compra-credito.destroy',$row->id],'method'=>'delete']) !!}
                            <button class="btn btn-danger btn-sm" ><i class=" icon-trash"></i> </button>
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row" style="border-radius: 0px;">
        <div class="col-md-5 col-md-offset-7">
            <p class="text-right"><b>Costo Compra :</b> {{\App\Tool::convertMoney($compra->totalCosto())}}</p>
            <p class="text-right">Total Pagado: {{\App\Tool::convertMoney($compra->totalCosto() - $compra->getTotalDeuda())}}</p>
            <hr>
            <h3 class="text-right">Saldo {{\App\Tool::convertMoney($compra->getTotalDeuda())}}</h3>
        </div>
    </div>
    <hr>
    <div class="hidden-print">
        <div class="pull-right">
            <a href="{{url('reportes/pagos/compra').\App\Tool::getDataReportQuery()}}">
                    <span class="btn btn-inverse waves-effect waves-light" >
                            <i class=" icon-printer"></i>
                            Imprimir Pagos
                        </span>
            </a>
        </div>
    </div>

</div>
