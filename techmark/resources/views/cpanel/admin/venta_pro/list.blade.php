@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <div class="col-sm-12">
            @include('cpanel.admin.venta_pro.partials.report')

        </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-12">
          @include('cpanel.admin.venta_pro.partials.search')
      </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="table-rep-plugin">
                    <div class="table-responsive" data-pattern="priority-columns">

                       @include('cpanel.admin.venta_pro.partials.tablelist')

                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="pull-left">
            {{$ventas->appends(Request::only(['s']))->render()}}
        </div>
    </div>
@endsection
@section('css')
    <link href="{{url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    @if(Session::has('message'))
        <link href="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css">
    @endif
    <link href="{{url('assets/plugins/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

@endsection
@section('js')
    <script src="{{url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>

    <script src="{{url('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>

    <script>
        $(".select2").select2();
    </script>

    @if(Session::has('message'))
        <script src="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script>
            $(window).load(function(){
                swal({
                    title: "{!! Session::get('venta-dead') !!}",
                    text: "{!! Session::get('message') !!}",
                    type: "info",
                    showCancelButton: false,
                    cancelButtonClass: 'btn-white btn-md waves-effect',
                    confirmButtonClass: 'btn-info btn-md waves-effect waves-light',
                    confirmButtonText: 'Aceptar'
                });
            });

        </script>
    @endif

    <script src="{{url('assets/plugins/moment/moment.js')}}"></script>

    <script src="{{url('assets/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
    <script src="{{url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{url('assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>
    <script src="{{url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/plugins/es.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function() {
            $(".select2").select2();
            $('.selectpicker').selectpicker();
            moment.locale('es');
            $('.input-daterange-timepicker').daterangepicker({
                timePicker: false,
                timePickerIncrement: 30,
                @if(!Request::get('fecha'))
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                @endif
                locale: {
                    format: 'DD/MM/YYYY'
                },

                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-default',
                cancelClass: 'btn-white'
            });
        });
    </script>
    @include('cpanel.partials.iTiket');
@endsection