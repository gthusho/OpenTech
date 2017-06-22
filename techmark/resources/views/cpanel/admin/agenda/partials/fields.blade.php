<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="text-dark header-title m-t-0">DATOS DE LA ACTIVIDAD</h4>
            <p class="text-danger m-b-30 font-13">
                * Los campos con (*) son obligatorios
            </p>
            <div class="row">
                <div class="form-group col-lg-12">
                    {!! Form::label('Categoria  (*)')!!}
                    {!! Form::select('categoria',Config::get('gthusho.categorias_agenda'),null,['class'=>'selectpicker','placeholder'=>'Seleccione la categoria','required'])!!}

                </div>
                <div class="form-group col-lg-12">
                    {!! Form::label('Asunto de la Actividad * ')!!}
                    {!! Form::text('asunto',null,['class'=>'form-control','required'])!!}
                </div>
                <div class="form-group col-lg-12">
                    <label class=" control-label">Fecha Realizacion Actividad *</label>
                    {!! Form::text('fecha',null,['class'=>'form-control input-daterange-timepicker','required'])!!}
                </div>
                <div class="form-group col-lg-12">
                    {!! Form::label('Descripcion de la Actividad')!!}
                    {!! Form::textarea('descripcion',null,['class'=>'form-control',''])!!}
                </div>

            </div>

        </div>

    </div>
    <!-- end col -->

    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="text-dark header-title m-t-0">OTROS DATOS</h4>
            <p class="text-danger font-13">
                * Los campos con (*) son obligatorios
            </p>

            <div class="row">

                <div class="form-group">
                    {!! Form::label('Contacto / Planificado con ')!!}

                    {!! Form::text('planificado',null,['class'=>'  form-control'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('ubicacion ')!!}

                    {!! Form::text('ubicacion',null,['class'=>' form-control'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('Adjuntar Archivo')!!}
                    <input type="file" class="filestyle" data-placeholder="sin imagen" name="archivo">
                </div>
            </div>

        </div>
        @if(Request::segment(4)=='edit' && $actividad->archivo!='')
            <div class="card-box">
                <h4 class="text-primary header-title m-t-0">Archivo Adjunto</h4>

                <div class="row">
                    <div class="form-group col-lg-12">
                        <a href="{{$actividad->getArchivo()}}" target="_blank">{{$actividad->archivo}}</a>
                    </div>
                </div>

            </div>
        @endif
    </div>
    <!-- end col -->
</div>

