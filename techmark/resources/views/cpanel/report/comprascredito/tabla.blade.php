
<table  cellspacing="5"  >
    <tr>
        <th width="5%" ><strong>#</strong></th>
        <th width="10%" ><strong>CODIGO</strong></th>
        <th width="10%" ><strong>FECHA</strong></th>
        <th width="15%"><strong>SUCURSAL</strong></th>
        <th width="20%"><strong>CANTIDAD ARTICULOS</strong></th>
        <th width="15%"><strong>COSTO TOTAL</strong></th>
        <th width="10%"><strong>ABONO</strong></th>
        <th width="10%"><strong>SALDO</strong></th>
    </tr>
    <?php
    $i=1;
    ?>
    @foreach($compras as $row)
        <tr >
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->id)}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->fecha)}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->sucursal->nombre)}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->totalCantidad()}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->totalCosto()}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->getTotalAbonos()}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->getTotalDeuda()}}</td>

        </tr>
    @endforeach
</table>
