<div class="row">
    <div class="form-group col-lg-8">
        {!! Form::label('Cliente (*) ')!!}
        {!! Form::select('cliente_id',$clientes,null,['class'=>'form-control select2','placeholder'=>'Seleccione un cliente','required','id'=>'cliente'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" id="addCliente" ><i class="icon-plus"></i> Cliente</span>
    </div >
</div>