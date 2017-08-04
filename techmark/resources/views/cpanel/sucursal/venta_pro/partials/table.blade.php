<div class="table-rep-plugin">
    <div class="table-responsive custList" data-pattern="priority-columns">
        <table class="table table-hover" id="tabla">
            <thead>
            <tr>
                <th>#</th>
                <th>IMAGEN</th>
                <th>PRODUCTO</th>
                <th>TALLA</th>
                <th>P/U</th>
                <th>CANTIDAD</th>
                <th>TOTAL</th>
                <th>REMOVER</th>
            </tr>
            </thead>

            <tbody>
                <?php $i=1; ?>
                @foreach($venta->detalleventas as $row)
                    <tr class="rows" data-id="{{$row->id}}">
                        <td>{{$i++}}</td>
                        <td>
                            <img src="{{$row->producto->getImagen()}}" alt="" class="img img-thumbnail thumb-sm">
                        </td>
                        <td>
                            {{$row->producto->descripcion}}

                        </td>
                        <td>
                            {{$row->talla->nombre}}
                        </td>
                        <td>
                            <?php
                            $punitario = 0;
                            $pt =  \App\ProductoTalla::where('producto_id',$row->producto_id)->where('talla_id',$row->talla_id)->get()->first();
                            if(\App\Tool::existe($pt)){
                                switch ($row->dp){
                                    case 'P1':{
                                        $punitario = $pt->precio1;
                                        break;
                                    }
                                    case 'P2':{
                                        $punitario = $pt->precio2;
                                        break;
                                    }
                                    case 'P3':{
                                        $punitario = $pt->precio3;
                                        break;
                                    }
                                    default: break;
                                }

                            }
                            ?>
                            {{\App\Tool::convertMoney($punitario)}}

                        </td>
                        <td>{{$row->cantidad}}</td>
                        <td>{{\App\Tool::convertMoney(($row->precio))}}</td>
                        <td>
                            @if(Request::segment(5)!='edit')
                            {!! Form::open(['route'=>['s.destroyItemCar',$row->id],'method'=>'delete']) !!}
                            <button class="btn btn-danger btn-sm" ><i class=" icon-trash fa-2x"></i> </button>
                            {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
