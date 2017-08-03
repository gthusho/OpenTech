
<table  cellspacing="5"  >
    <tr>
        <th width="5%" ><strong>#</strong></th>
        <th width="15%" ><strong>VENTA</strong></th>
        <th width="10%" ><strong>FECHA</strong></th>
        <th width="27%"><strong>PRODUCTO</strong></th>
        <th width="12%"><strong>TALLA</strong></th>
        <th width="10%"><strong>CANTIDAD</strong></th>
        <th width="20%"><strong>SUCURSAL</strong></th>
    </tr>
    <?php
    $i=1;
    ?>
    @foreach($egresos as $row)
        <tr >
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->ventaproducto->getcode())}}</td>
            <td style="border-bottom: 1px dashed black;">{{date('d/m/Y',strtotime($row->registro))}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->producto->descripcion)}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->talla->nombre)}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->cantidad)}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->sucursal->nombre)}}</td>

        </tr>
    @endforeach

</table>