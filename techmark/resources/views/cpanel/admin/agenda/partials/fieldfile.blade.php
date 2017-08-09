<div class="card-box">
    <h4 class="text-primary header-title m-t-0">Archivo Adjunto</h4>
    <div class="row">
        <div class="form-group col-lg-11">
            <a href="{{$actividad->getArchivo()}}" target="_blank">{{$actividad->archivo}}</a>
        </div>
        <div class="pull-right col-lg-1">
            {!! Form::open(['route'=>['archivoAgenda',$actividad->id],'method'=>'post','id'=>'delete-file']) !!}
            <button class="btn btn-danger btn-sm" id="btn-file"><i class="icon-trash"></i></button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

