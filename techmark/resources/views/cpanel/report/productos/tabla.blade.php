
<table  cellspacing="5"  >
    <tr>
        <th width="2%" ><strong>#</strong></th>
        <th width="8%" align="center"><strong>ESTADO</strong></th>
        <th width="25%" align="center"><strong>DESCRIPCION</strong></th>
        <th width="10%" ><strong>CODIGO</strong></th>
        <th width="15%" align="center"><strong>CODIGO BARRA</strong></th>
        <th width="40%" align="center"><strong>TALLAS</strong></th>
    </tr>
    <?php
    $i=1;
    ?>

    @foreach($productos as $row)
        <tr >
            <td style="border-bottom: 1px dashed black;">{{$i++}}</td>
            <td align="center" style="border-bottom: 1px dashed black;"><span class="label label-{{$row->activo()[0]}}">{{$row->activo()[1]}}</span></td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->descripcion)}}</td>
            <td style="border-bottom: 1px dashed black;">{{$row->codigo}}</td>
            <td style="border-bottom: 1px dashed black;">{{ucwords($row->codigobarra)}}</td>
            <td style="border-bottom: 1px dashed black;">
                @if($row->tallas->count()>0)
                    <table class="table table-hover">
                        <thead>
                        <tr class="bg-custom ">
                            <th style="border-bottom-style: 1px dashed black;">TALLA</th>
                            <th style="border-bottom-style: 1px dashed black;">PRECIO 1</th>
                            <th style="border-bottom-style: 1px dashed black;">PRECIO 2</th>
                            <th style="border-bottom-style: 1px dashed black;">PRECIO 3</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($row->tallas as $fila)
                            <tr>
                                <td >{{$fila->talla->nombre}}</td>
                                <td>{{\App\Tool::convertMoney($fila->precio1)}}</td>
                                <td>{{\App\Tool::convertMoney($fila->precio2)}}</td>
                                <td>{{\App\Tool::convertMoney($fila->precio3)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <b>No Disponible</b>
                @endif

            </td>
        </tr>
    @endforeach

</table>