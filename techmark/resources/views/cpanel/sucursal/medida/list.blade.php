@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <div class="col-sm-12">
            @include('cpanel.admin.medida.partials.report')

        </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-12">
          @include('cpanel.admin.medida.partials.search')
      </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="table-rep-plugin">
                    <div class="table-responsive" data-pattern="priority-columns">
                        @include('cpanel.sucursal.medida.partials.table')
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="pull-left">
            {{$medidas->appends(Request::only(['s']))->render()}}
        </div>
    </div>
@endsection
@section('css')
    @if(Session::has('message'))
        <link href="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css">
    @endif
    <link href="{{url('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
    @if(Session::has('message'))
        <script src="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script>
            $(window).load(function(){
                swal({
                    title: "{{Session::get('medida-dead')}}",
                    text: "{{Session::get('message')}}",
                    type: "info",
                    showCancelButton: false,
                    cancelButtonClass: 'btn-white btn-md waves-effect',
                    confirmButtonClass: 'btn-info btn-md waves-effect waves-light',
                    confirmButtonText: 'OK!'
                });
            });

        </script>
    @endif
    <script src="{{url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>

    <script src="{{url('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>

    <script>
        // Select2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //validation

    </script>
@endsection