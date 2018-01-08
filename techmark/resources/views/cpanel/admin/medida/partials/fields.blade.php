<div class="row">
    <div class="col-lg-5">
        <div class="panel panel-border panel-custom">
            <div class="panel-heading">
                <h3 class="panel-title">INFORMACION</h3>
            </div>
            <div class="panel-body">
                <div class="form-group col-lg-10">
                    {!! Form::label('Cliente (*) ')!!}
                    {!! Form::select('cliente_id',$clientes,null,['class'=>'form-control select2','placeholder'=>'Seleccione un cliente','required','id'=>'cliente'])!!}
                </div>
                <div class="form-group col-lg-1">
                    <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" id="addCliente" ><i class="icon-plus"></i> Cliente</span>
                </div >
                <div class="form-group col-lg-6">
                    {!! Form::label('Fecha de visita (*) ')!!}
                    <div class="input-group">
                        {!! Form::text('fecha',null,['class'=>'form-control','id'=>"datepicker-autoclose", 'data-date-format'=>'yyyy-mm-dd','required'])!!}
                        <span class="input-group-addon bg-primary b-0 text-white"><i class="icon-calender"></i></span>
                    </div>
                </div>
                <div class="form-group col-lg-6">
                    {!! Form::label('Hora de visita (*) ')!!}
                    <div class="input-group">
                        {!! Form::text('hora',null,['class'=>'form-control','id'=>"clockpicker",'required'])!!}
                        <span class="input-group-addon bg-primary b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Observaciones ')!!}
                    {!! Form::textarea('observacion',null,['class'=>'form-control','rows'=>'6'])!!}
                </div>
                @if(Request::segment(4)=='edit')
                    <br>
                    <div class="row">
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                Actualizar
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="panel panel-border panel-custom">
            <div class="panel-heading">
                <h3 class="panel-title">UBICACION</h3>
            </div>
            <div class="panel-body">
                <div class="form-group col-lg-4">
                    {!! Form::label('Direccion (*) ')!!}
                    {!! Form::text('direccion',null,['class'=>'form-control','required'])!!}
                </div>
                <div class="form-group col-lg-4">
                    {!! Form::label('Zona ')!!}
                    {!! Form::text('zona',null,['class'=>'form-control'])!!}
                </div>
                <div class="form-group col-lg-4">
                    {!! Form::label('Barrio ')!!}
                    {!! Form::text('barrio',null,['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    <label class=" control-label">Buscar lugar: (*)</label>

                    <input type="text" class="form-control" id="us3-address" />
                </div>
                <div id="map_canvas" style="height: 250px">
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('x',null,['id'=>'x'])!!}
    {!! Form::hidden('y',null,['id'=>'y'])!!}
</div>