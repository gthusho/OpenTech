
{!! Form::model(Request::all(), ['route' => ['admin.usuario.index'],'method'=>'GET']) !!}
        <div class="form-group">
            <div class="input-group">
                {!!  Form::text('s',null,['class'=>"form-control" ,'placeholder'=>"Buscar por nombre"]) !!}
                <span class="input-group-btn">
                    <button type="submit" class="btn waves-effect waves-light btn-primary"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div> <!-- form-group -->
{!! Form::close() !!}