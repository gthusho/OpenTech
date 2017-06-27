@if(Request::segment(4)=='edit')
    <div class="form-group col-lg-12" >
        {!! Form::label('Estado del Trabajaor (*) ')!!}
        {!! Form::select('estado',[1=>'Activo',0=>'Inactiva'],null,['class'=>'selectpicker','required'])!!}
    </div>
@endif
<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="text-dark header-title m-t-0">DATOS DEL TRABAJADOR</h4>
            <p class="text-danger m-b-30 font-13">
                * Los campos con (*) son obligatorios
            </p>
            <div class="row">
                <div class="form-group col-lg-12">
                    {!! Form::label('Nombre Trabajador (*) ')!!}
                    {!! Form::text('nombre',null,['class'=>'form-control','required'])!!}
                </div>
                <div class="form-group col-lg-6">
                    {!! Form::label('Carnet de Identidad (*)')!!}
                    {!! Form::text('ci',null,['class'=>'form-control','required'])!!}
                </div>
                <div class="form-group col-lg-6">
                    {!! Form::label('Direccion (*)')!!}
                    {!! Form::text('direccion',null,['class'=>'form-control','required'])!!}
                </div>
                <div class="form-group col-lg-6">
                    {!! Form::label('Telefono (*)')!!}
                    {!! Form::text('telefono',null,['class'=>'form-control','required'])!!}
                </div>
                <div class="form-group col-lg-6">
                    {!! Form::label('Email (*)')!!}
                    {!! Form::text('email',null,['class'=>'form-control','required'])!!}
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
                <div class="form-group col-lg-6">
                    {!! Form::label('Sucursal (*) ')!!}
                    {!! Form::select('sucursal_id',$sucursales,null,['class'=>'form-control select2','required','placeholder'=>'Sucursal'])!!}
                </div>
                <div class="form-group col-lg-6">
                    {!! Form::label('Cargo (*)')!!}
                    {!! Form::text('cargo',null,['class'=>'form-control','required'])!!}
                </div>
                <div class="form-group col-lg-6">
                    {!! Form::label('Sueldo (*)')!!}
                    {!! Form::text('sueldo',null,['class'=>'form-control','required'])!!}
                </div>
                <div class="form-group col-lg-6">
                    {!! Form::label('Fecha Ingreso (*)')!!}
                    {!! Form::text('fecha_ingreso',null,['class'=>'form-control'])!!}
                </div>
                <div class="form-group col-lg-6">
                    {!! Form::label('Referencia (*)')!!}
                    {!! Form::text('referencia',null,['class'=>'form-control','required'])!!}
                </div>
                <div class="form-group col-lg-6">
                    {!! Form::label('Telefono Referencia (*)')!!}
                    {!! Form::text('tel_referencia',null,['class'=>'form-control','required'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('Adjuntar Foto')!!}
                    <input type="file" class="filestyle" data-placeholder="sin imagen" name="foto">
                </div>
            </div>

        </div>
        @if(Request::segment(4)=='edit' && $trabajador->foto!='')
            <div class="card-box">
                <h4 class="text-primary header-title m-t-0">Foto</h4>

                <div class="row">
                    <div class="form-group col-lg-12">
                        <a href="{{$trabajador->getFoto()}}" target="_blank">{{$trabajador->foto}}</a>
                    </div>
                </div>

            </div>
        @endif
    </div>
    <!-- end col -->
</div>





















