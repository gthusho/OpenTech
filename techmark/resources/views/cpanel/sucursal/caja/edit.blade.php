@extends('theme.ubold.layout_cpanel')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Cerrar Caja</b></h4>
                <p class="text-danger font-13 m-b-30">
                    * Los campos con (*) son obligatorios
                </p>
                @include('cpanel.partials.errors')
                {!! Form::model($caja,['route'=>['s.caja.update',$caja->id],'method'=>'put']) !!}
                    @include('cpanel.sucursal.caja.partials.fields')
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                            Cerrar
                        </button>
                        <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                            Cancelar
                        </button>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
    <script>
        $(window).load(function(){
            @if(Session::has('message'))
            swal("{!! Session::get('message') !!}", " ", "success")
            @endif
        });
    </script>
    <script src="{{url('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/plugins/autoNumeric/autoNumeric.js')}}" type="text/javascript"></script>

    <script type="text/javascript">

        jQuery(function($) {
            $('.autonumber').autoNumeric('init');
        });
    </script>

    <script>
        function parseCurrency( num ) {
            return parseFloat( num.replace( /,/g, '') );
        }

        $("#mcierre").on("keyup keypress change paste", function(){
            var saldo = "{{($caja->totalIG() + $caja->apertura)}}";
            var ret =  parseCurrency(($(this).val())) - parseCurrency(saldo);
            $("#diferencia").val(ret);
        })
    </script>
@endsection