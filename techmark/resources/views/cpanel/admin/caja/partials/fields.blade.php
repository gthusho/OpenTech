<div class="row">
    @if(Request::segment(4)=='edit')
        <div class="form-group col-lg-12" >
            {!! Form::label('Estado de la caja(*) ')!!}
            {!! Form::select('estado',['p'=>'Activa','t'=>'Cerrada'],null,['class'=>'selectpicker','required'])!!}
        </div>
    @endif

</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('Usuario en caja (*) ')!!}
            {!! Form::select('usuario_id',$usuarios,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione un Usuario'])!!}
        </div >
        <div class="form-group">
            {!! Form::label('Sucursal (*)')!!}
            {!! Form::select('sucursal_id',$sucursales,null,['class'=>'form-control select2','required','placeholder'=>'Seleccione una Sucursal'])!!}
        </div>
        <div class="form-group col-lg-6">
            {!! Form::label('Total Apertura: (*)')!!}
            {!! Form::text('apertura',null,['class'=>'form-control autonumber','required'])!!}
        </div>
        <div class="form-group col-lg-6">
            {!! Form::label('Total Cierre: ')!!}
            {!! Form::text('cierre',null,['class'=>'form-control autonumber'])!!}
        </div>
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Observaciones')!!}
        {!! Form::textarea('observaciones',null,['class'=>'form-control','rows'=>'5'])!!}
    </div>
</div>
