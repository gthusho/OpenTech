
<table  cellspacing="5"  >
    <tr>
        <th width="3%" ><strong>#</strong></th>
        <th width="10%"><strong>FECHA</strong></th>
        <th width="16%" ><strong>USUARIO</strong></th>
        <th width="20%" ><strong>SUCURSAL</strong></th>
        <th width="26%"><strong>OBSERVACION</strong></th>
        <th width="12%"><strong>APERTURA</strong></th>
        <th width="12%"><strong>CIERRE</strong></th>
    </tr>
    <?php
    $i=1;
    ?>

    @foreach($cajas as $row)
        <tr >
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">{{date('d/m/Y',strtotime($row->registro))}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->usuario->nombre}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->sucursal->nombre)}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->observaciones)}}</td>
            <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->apertura)}}</td>
            <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->cierre)}}</td>

        </tr>
    @endforeach

</table>
