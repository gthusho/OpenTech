

<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">VENTA {{$venta->getCode()}}</h3>
    </div>
    <div class="panel-body">
        <ul class="list-unstyled">
            <li><span class="text-custom">Sucursal: </span>{{$venta->sucursal->nombre}}</li>
            <li><span class="text-custom">Almacen: </span>{{$venta->almacen->nombre}}</li>
            <li><span class="text-custom">Cantidad Articulos: </span>{{$venta->totalCantidad()}}</li>
            <li><span class="text-custom">Precio Venta: </span>{{\App\Tool::convertMoney($venta->totalPrecio())}}</li>
            <li><span class="text-custom">Saldo Venta: </span>{{\App\Tool::convertMoney($venta->getTotalDeuda())}}</li>
            <li><span class="text-custom">Fecha Venta: </span>{{date('d-m-Y',strtotime($venta->registro))}}</li>
            <li><span class="text-custom">Registro la Venta: </span>{{$venta->usuario->nombre}}</li>
        </ul>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">ABONAR CUOTAS</h3>
    </div>
    <div class="panel-body">
        {!! Form::open(['route'=>'admin.venta-credito-art.store','method'=>'post']) !!}
        <div class="input-group">
            {!! Form::text('fecha',null,['class'=>'form-control','required','autocomplete'=>"off",'id'=>"datepicker-autoclose",'data-date-format'=>'yyyy/mm/dd'])!!}
            <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
        </div>
        <div class="form-group">
            {!! Form::label('Monto a Abonar ')!!}
            <input name="abono" type="text" class="form-control autonumber cleanclean" autocomplete="off" id="abono" data-parsley-max="{{$venta->getTotalDeuda()}}" required>
        </div>
        <div class="form-group">
            {!! Form::label('Saldo  ')!!}
            <input name="saldo" type="text" class="form-control autonumber cleanclean" value="{{$venta->getTotalDeuda()}}" autocomplete="off" id="saldo" disabled>

        </div>
        <input name="venta_articulo_id" type="hidden" value="{{$venta->id}}">
      <div class="form-group  m-t-15">
          @if($venta->getTotalDeuda()!=0)
          <button  class="btn btn-primary waves-effect waves-light m-l-5" onclick="return confirm('Esta Seguro de Continuar?')">
              Registrar
          </button>
          @endif
      </div>
        {!! Form::close() !!}

    </div>
</div>