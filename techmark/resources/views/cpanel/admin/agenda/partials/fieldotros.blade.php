<div class="card-box">
    <h4 class="text-dark header-title m-t-0">OTROS DATOS</h4>
    <p class="text-danger font-13">
        * Los campos con (*) son obligatorios
    </p>
    <div class="row">
        <div class="form-group">
            {!! Form::label('Contacto / Planificado con ')!!}
            <div class="tags-default">
                {!! Form::text('planificado',null,['class'=>'  form-control','data-role'=>'tagsinput','placeholder'=>'Agregar Información'])!!}
            </div>
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

