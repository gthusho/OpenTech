<fieldset class="scheduler-border">
    <legend class="scheduler-border">BUSCAR ARTICULO</legend>
    <div class="form-group col-lg-5">
        {!! Form::label('Codigo  ')!!}
        {!! Form::text('nit',null,['class'=>'form-control','autocomplete'=>'of'])!!}
    </div>
    <div class="form-group col-lg-5">
        {!! Form::label('Codigo Barras ')!!}
        {!! Form::text('codigobarra',null,['class'=>'form-control','autocomplete'=>'of'])!!}
    </div>
    <div class="form-group col-lg-2">
        <span class="btn btn-inverse waves-effect waves-light  btn-sm pull-right m-t-30"  id="Search"><i class=" icon-magnifier"></i>  Articulo</span>

    </div>
</fieldset>
