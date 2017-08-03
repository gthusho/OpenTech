
<table  cellspacing="5"  >
    <tr>
        <th width="3%" ><strong>#</strong></th>
        <th width="10%" ><strong>CODIGO</strong></th>
        <th width="15%" ><strong>FECHA</strong></th>
        <th width="20%" ><strong>SUCURSAL</strong></th>
        <th width="20%" ><strong>CLIENTE</strong></th>
        <th width="15%" ><strong>CANTIDAD PRODUCTOS</strong></th>
        <th width="15%"><strong>PRECIO TOTAL</strong></th>
    </tr>
    <?php
    $i=1;
    ?>

    @foreach($ventas as $row)
        <tr >
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->getCode()}}</td>
            <td style="border-bottom: 1px dashed black;">{{date('d/m/Y',strtotime($row->registro))}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->sucursal->nombre)}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->cliente->razon_social)}}<br><b>Nit:</b>{{ucwords($row->cliente->nit)}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->totalCantidad()}}</td>
            <td style="border-bottom: 1px dashed black;">{{\App\Tool::convertMoney($row->totalPrecio())}}</td>
        </tr>
    @endforeach
</table>

