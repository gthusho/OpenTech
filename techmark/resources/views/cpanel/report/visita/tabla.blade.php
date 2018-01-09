<table cellspacing="5" >
    <tr>
        <th width="5%">#</th>
        <th width="18%">CLIENTE</th>
        <th width="16%">FECHA</th>
        <th width="19%">DIRECCION</th>
        <th width="12%">BARRIO</th>
        <th width="10%">ZONA</th>
        <th width="20%">OBSERVACION</th>
    </tr>
    <?php
    $i=1;
    ?>
    @foreach($visitas as $row)
        <tr>
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td style="border-bottom: 1px dashed black;">
                {{($row->cliente->razon_social)}}
            </td>
            <td style="border-bottom: 1px dashed black;">
                {{date('d/m/Y',strtotime($row->fecha)) .' '. $row->hora}}
            </td>
            <td style="border-bottom: 1px dashed black;">
                {{$row->direccion}}
            </td>
            <td style="border-bottom: 1px dashed black;">
                {{$row->barrio}}
            </td>
            <td style="border-bottom: 1px dashed black;">
                {{$row->zona}}
            </td>
            <td style="border-bottom: 1px dashed black;">
                {{$row->observacion}}
            </td>
        </tr>
    @endforeach
</table>