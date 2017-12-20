@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        @include('cpanel.partials.errors')
        {!! Form::model($produccion,['route'=>['clientes.entregarProduccion.ok',$produccion->id],'method'=>'post','files'=>true,'id'=>'form-produccion']) !!}
        <div class="row">
            <div class="col-lg-5">
                @include('cpanel.admin.produccion_cli.partials.infoProduccion')
            </div>
            <div class="col-lg-7">
                <div class="panel panel-border panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">INFORMACION ENTREGA</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                {!! Form::label('Quien Recoge ')!!}
                                {!! Form::text('recogio',null,['class'=>'form-control '])!!}
                            </div>
                            <div class="form-group col-lg-12">
                                {!! Form::label('Fecha Entrega *')!!}
                                <div class="input-group">
                                    {!! Form::text('fecha_entrega',null,['class'=>'form-control','required','autocomplete'=>"off",'id'=>"datepicker-autoclose",'data-date-format'=>'yyyy/mm/dd'])!!}
                                    <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                                </div>
                            </div>
                            <div id="mensaje" class="col-lg-12">
                            </div>
                            <div class="form-group col-lg-12">
                                <br><br>
                                <button class="btn btn-success btn-sm pull-right"><i class=" icon-present fa-2x"></i>  Entregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    @include('cpanel.admin.produccion_cli.partials.modals')
@endsection

@section('css')
    <style>

        fieldset{
            margin-bottom: 2px;
        }
        fieldset.scheduler-border {
            border: solid 1px #DDD !important;
            padding: 0 5px 7px 5px;
            border-bottom: none;
        }

        legend.scheduler-border {
            width: auto !important;
            border: none;
            font-size: 10px;
            margin-bottom: 0px;
        }
        label{
            font-size: 12px !important;

        }
        .form-group{
            margin-bottom: 0px !important;
        }
    </style>
    @include('cpanel.admin.produccion_cli.addons.css')
@endsection
@section('js')
    @include('cpanel.admin.produccion_cli.addons.js')
@endsection