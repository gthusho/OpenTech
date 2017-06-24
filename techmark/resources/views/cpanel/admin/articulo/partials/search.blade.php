
{!! Form::model(Request::all(), ['route' => ['admin.articulo.index'],'method'=>'GET']) !!}
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-btn">
                    {!! Form::select('buscar',[1=>'Articulo',2=>'Categoria',3=>'Marca',4=>'Material',5=>'Medida'],null,['class'=>'dropdown-toggle btn-primary btn waves-effect waves-light'])!!}
                </span>
                {!!  Form::text('s',null,['class'=>"form-control" ,'placeholder'=>"Buscar"]) !!}
                <span class="input-group-btn">
                    <button type="submit" class="btn waves-effect waves-light btn-primary"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div> <!-- form-group -->
{!! Form::close() !!}
