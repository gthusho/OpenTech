<fieldset class="scheduler-border">
    <legend class="scheduler-border">OPERACIONES</legend>
    @if(Request::segment(5)!='edit')
    <div class="form-group">
        <button type="submit" class="btn btn-inverse waves-effect waves-light  btn-sm pull-right m-t-30"  id="AddItemCart"><i class=" icon-basket"></i>  Agregar</button>

    </div>
    @endif
    <div class="form-group">
        <span class="btn btn-inverse waves-effect waves-light  btn-sm pull-right m-t-30"  id="ClearItemCart"><i class=" ti-brush-alt"></i>  Limpiar</span>

    </div>
</fieldset>