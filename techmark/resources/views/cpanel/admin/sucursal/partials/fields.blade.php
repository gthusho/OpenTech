<div class="row">
    @if(Request::segment(4)=='edit')
        <div class="form-group col-lg-12" >
            {!! Form::label('Estado de la Cuenta (*) ')!!}
            {!! Form::select('estado',['1'=>'Activa','0'=>'Inhabilitado'],null,['class'=>'selectpicker','required'])!!}
        </div>
    @endif

    <div class="form-group col-lg-6">
        {!! Form::label('Nombre Sucursal * ')!!}
        {!! Form::text('nombre',null,['class'=>'form-control','required'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Ciudad  * ')!!}
        {!! Form::select('ciudad_id',$ciudades,null,['class'=>'form-control select2','required','placeholder'=>'Selecciones una Ciudad','id'=>'ciudad'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('NIT (*)')!!}
        {!! Form::text('nit',null,['class'=>'form-control','required'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Dirección (*)')!!}
        {!! Form::text('direccion',null,['class'=>'form-control','required'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Telefono  ')!!}
        {!! Form::text('telefono',null,['class'=>'form-control',''])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Celular ')!!}
        {!! Form::text('celular',null,['class'=>'form-control',''])!!}
    </div>

</div>
<div class="row m-t-5">

    <div class="col-lg-6">
        <div class="panel panel-border panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title"> ASIGNACION DE ALMACEN</h3>
            </div>
            <div class="panel-body" id="depositos">
                @if(Request::segment(4)=='edit')
                    <?php
                       $ojos = \App\AlmacenSucursal::where('sucursal_id',$sucursal->id)->get()->lists('almacen_id')->toArray();
                    ?>
                    @foreach(\App\Almacen::where('ciudad_id',$sucursal->ciudad_id)->get() as $row)
                        <?php
                          $chek = '';
                            if(in_array($row->id,$ojos))
                                $chek = 'checked';
                            else
                                $chek = '';


                        ?>
                    <div class='checkbox checkbox-inverse'>
                        <input id='{{$row->id}}' type='checkbox' name='depositos[]' {{$chek}} value="{{$row->id}}">
                        <label for='{{$row->id}}'>
                            {{$row->nombre}}
                        </label>
                    </div>
                    @endforeach
                @else
                    <p>Esperando ciudad para generar datos...</p>
                @endif
            </div>
        </div>
    </div>
    @if(Request::segment(4)=='edit')
    <div class="col-lg-6">
        <div class="panel panel-border panel-custom">
            <div class="panel-heading">
                <h3 class="panel-title"> ALMACENES ASIGNADOS ACTUALMENTE</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                        <th>ALMACEN</th>
                        <th>DIRECCION</th>
                    </tr>
                    @foreach($sucursal->depositos as $row)
                    <tr>
                        <td>{{$row->almacen->nombre}}</td>
                        <td>{{$row->almacen->direccion}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
