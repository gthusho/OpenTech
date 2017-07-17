<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">COMPRA {{$compra->getCode()}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tr>
                <td><span class="text-custom">Sucursal </span></td>
                <td>{{$compra->sucursal->nombre}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Almacen </span></td>
                <td>{{$compra->almacen->nombre}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Cantidad de Articulos </span></td>
                <td>{{$compra->totalCantidad()}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Costo Compra </span></td>
                <td>{{\App\Tool::convertMoney($compra->totalCosto())}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Saldo Compra </span></td>
                <td>{{\App\Tool::convertMoney($compra->getTotalDeuda())}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Fecha Compra</span></td>
                <td>{{date('d-m-Y',strtotime($compra->fecha))}}</td>
            </tr>
            <tr>
                <td><span class="text-custom">Registro Compra </span></td>
                <td>{{$compra->usuario->nombre}}</td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title">ABONAR CUOTAS</h3>
    </div>
    <div class="panel-body">
        {!! Form::open(['route'=>'admin.compra-credito.store','method'=>'post']) !!}
        <div class="input-group">
            {!! Form::text('fecha',null,['class'=>'form-control','required','autocomplete'=>"off",'id'=>"datepicker-autoclose",'data-date-format'=>'yyyy/mm/dd'])!!}
            <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
        </div>
        <div class="form-group">
            {!! Form::label('Monto a Abonar ')!!}
            <input name="abono" type="text" class="form-control autonumber cleanclean" autocomplete="off" id="abono" data-parsley-max="{{$compra->getTotalDeuda()}}" required>
        </div>
        <div class="form-group">
            {!! Form::label('Saldo  ')!!}
            <input name="saldo" type="text" class="form-control autonumber cleanclean" value="{{$compra->getTotalDeuda()}}" autocomplete="off" id="saldo" disabled>

        </div>
        <input name="compra_id" type="hidden" value="{{$compra->id}}">
      <div class="form-group  m-t-15">
          <button  class="btn btn-primary waves-effect waves-light m-l-5" onclick="return confirm('Esta Seguro de Continuar?')">
              Registrar
          </button>
      </div>
        {!! Form::close() !!}

    </div>
</div>