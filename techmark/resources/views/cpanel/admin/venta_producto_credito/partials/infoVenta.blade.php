<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">COMPRA {{$venta->getCode()}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tr>
                <td><span class="text-custom">Sucursal </span></td>
                <td>{{$venta->sucursal->nombre}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Cantidad de Articulos </span></td>
                <td>{{$venta->totalCantidad()}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Precio Venta </span></td>
                <td>{{\App\Tool::convertMoney($venta->totalPrecio())}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Saldo Venta </span></td>
                <td>{{\App\Tool::convertMoney($venta->getTotalDeuda())}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Fecha Venta</span></td>
                <td>{{date('d-m-Y',strtotime($venta->registro))}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Registro la Venta </span></td>
                <td>{{$venta->usuario->nombre}}</td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">ABONAR CUOTAS</h3>
    </div>
    <div class="panel-body">
        {!! Form::open(['route'=>'admin.ventas.creditos.productos.store','method'=>'post']) !!}
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
        <input name="venta_producto_id" type="hidden" value="{{$venta->id}}">
      <div class="form-group  m-t-15">
          <button  class="btn btn-primary waves-effect waves-light m-l-5" onclick="return confirm('Esta Seguro de Continuar?')">
              Registrar
          </button>
      </div>
        {!! Form::close() !!}

    </div>
</div>