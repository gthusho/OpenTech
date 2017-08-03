
<table  cellspacing="5"  >
    <tr>
        <th width="5%" ><strong>#</strong></th>
        <th width="10%" ><strong>CODIGO</strong></th>
        <th width="10%" ><strong>FECHA</strong></th>
        <th width="18%"><strong>SUCURSAL</strong></th>
        <th width="20%"><strong>CLIENTE</strong></th>
        <th width="15%"><strong>PRECIO TOTAL</strong></th>
        <th width="10%"><strong>ABONO</strong></th>
        <th width="10%"><strong>SALDO</strong></th>
    </tr>
    <?php
    $i=1;
    ?>
    @foreach($ventas as $row)
        <tr >
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->getcode())}}</td>
            <td style="border-bottom: 1px dashed black;">{{date('d/m/Y',strtotime($row->registro))}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->sucursal->nombre)}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->cliente->razon_social)}}<br><b>Nit:</b>{{ucwords($row->cliente->nit)}}</td>
            <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->totalPrecio())}}</td>
            <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->getTotalAbonos())}}</td>
            <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->getTotalDeuda())}}</td>
        </tr>
    @endforeach
</table>
