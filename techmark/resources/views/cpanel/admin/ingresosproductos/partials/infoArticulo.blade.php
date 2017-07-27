<fieldset class="scheduler-border">
    <legend class="scheduler-border">DATOS PRODUCTO</legend>
    <div class="row">
        <div class="form-group col-lg-12">
            {!! Form::label('Nombre ')!!}
            {!! Form::text('producto',null,['class'=>'form-control cleanclean','readonly'=>true,'id'=>'Pnombre'])!!}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <img id="pimagen" src="{{url('system/productos/defaultstore.jpg')}}" alt="" class="img img-thumbnail img-responsive m-t-10 m-l-10">
        </div>
        <div class="col-lg-8">
           <div class="row">
               <div class="form-group m-t-5">
                   <label for="astock" class="col-md-2">Stok Actual</label>
                   <div class="col-md-10">
                       {!! Form::text('stock',null,['class'=>'form-control   cleanclean','disabled','id'=>'pstock'])!!}
                   </div>
               </div>
           </div>
            <div class="row">
                <div class="form-group m-t-5">
                    <label for="aprecio1" class="col-md-2 ">P 1</label>
                    <div class="col-md-10">
                        {!! Form::text('precio1',null,['class'=>'form-control cleanclean','disabled','id'=>'aprecio1'])!!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group m-t-5">
                    <label for="aprecio2" class="col-md-2 control-label">P 2</label>
                    <div class="col-md-10">
                        {!! Form::text('precio2',null,['class'=>'form-control cleanclean','disabled','id'=>'aprecio2'])!!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group m-t-5">
                    <label for="aprecio3" class="col-md-2 control-label">P 3</label>
                    <div class="col-md-10">
                        {!! Form::text('precio3',null,['class'=>'form-control cleanclean','disabled','id'=>'aprecio3'])!!}
                    </div>
                </div>
            </div>
        </div>
    </div>

        {!! Form::hidden('producto_id',null,['class'=>'form-control cleanclean','id'=>'producto_id'])!!}
        {!! Form::hidden('talla_id',null,['class'=>'form-control cleanclean','id'=>'talla_id'])!!}
</fieldset>
