<div class="row">
    <div class="form-group col-lg-12" >
        <img src="{{$producto->getImagen()}}" class="img-thumbnail">
    </div>

    <div class="form-group col-lg-12" >
        {!! Form::label('producto')!!}
        {!! Form::text('producto',$producto->descripcion,['class'=>'form-control','disabled'])!!}
        {!! Form::hidden('producto_id',$producto->id)!!}
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-11" >
        {!! Form::label('Talla (*) ')!!}
        {!! Form::select('talla_id',$tallas,null,['class'=>'form-control select2','required','id'=>'talla'])!!}
    </div>
    <div class="form-group col-lg-1">
        <span class="btn btn-primary waves-effect waves-light m-t-30 btn-sm" id="addTalla"><i class="icon-plus"></i> Talla</span>
    </div >
</div>
<div class="row">
    <div class="form-group col-lg-4">
        {!! Form::label('Precio 1 * ')!!}
        {!! Form::text('precio1',null,['class'=>'form-control autonumber precio','required'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Precio 2 * ')!!}
        {!! Form::text('precio2',null,['class'=>'form-control autonumber precio','required'])!!}
    </div>
    <div class="form-group col-lg-4">
        {!! Form::label('Precio 3 * ')!!}
        {!! Form::text('precio3',null,['class'=>'form-control autonumber precio','required'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Precio 4 * ')!!}
        {!! Form::text('precio4',null,['class'=>'form-control autonumber precio','required'])!!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('Precio 5 * ')!!}
        {!! Form::text('precio5',null,['class'=>'form-control autonumber precio','required'])!!}
    </div>
</div>