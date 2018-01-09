
    <table  cellspacing="5"  >
        <tr>
            <th width="2%" ><strong>#</strong></th>
            <th width="15%" ><strong>ESTADO</strong></th>
            <th width="8%" ><strong>CODIGO</strong></th>
            <th width="12%" ><strong>FECHA</strong></th>
            <th width="18%"><strong>SUCURSAL</strong></th>
            <th width="36%"><strong>DESCRIPCION</strong></th>
            <th width="10%"><strong>COSTO PRODUCCION</strong></th>
        </tr>
        <?php
        $i=1;
        ?>

        @foreach($producciones as $row)
            <tr >
                <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
                <td  style="border-bottom: 1px dashed black;">
                    @if($row->checkState()[1]=='p'&& $row->terminado==0)<B>En Produccion </B>
                    @elseif($row->checkState()[1]=='t' && $row->terminado==1) <b>Entregado</b>

                    @elseif($row->checkState()[1]=='c' && $row->terminado==1)<b>Cancelada</b>
                    @elseif($row->checkState()[1]=='e')<b>Terminada</b>
                    @endif
                </td>
                <td style="border-bottom: 1px dashed black;">{{ucwords($row->getCode())}}</td>
                <td style="border-bottom: 1px dashed black;"><b>Inicio:</b> {{date('d/m/Y',strtotime($row->inicio))}}<br><b>Fin      :</b>   {{date('d/m/Y',strtotime($row->fin))}}</td>
                <td style="border-bottom: 1px dashed black;">{{$row->sucursal->nombre}}</td>
                <td style="border-bottom: 1px dashed black;"><b>Responsable: </b>{{$row->trabajador->nombre}}
                    <br><b>Cliente: </b> {{$row->cliente->razon_social}}
                    <br>{{$row->destino}} </td>
                <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->totalPrecio())}}</td>
            </tr>
        @endforeach
    </table>