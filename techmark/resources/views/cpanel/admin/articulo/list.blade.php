@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <div class="col-sm-12">
            @include('cpanel.admin.articulo.partials.report')

        </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-12">
          @include('cpanel.admin.articulo.partials.search')
      </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="table-rep-plugin">
                    <div class="table-responsive" data-pattern="priority-columns">
                        @include('cpanel.admin.articulo.partials.table')
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="pull-left">
            {{$articulos->appends(Request::only(['s']))->render()}}
        </div>
    </div>
@endsection
@section('css')
    <link href="{{url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    @if(Session::has('message'))
        <link href="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css">
    @endif
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
                    title: "{{Session::get('user-dead')}}",
                    text: "{{Session::get('message')}}",
                    type: "info",
                    showCancelButton: false,
                    cancelButtonClass: 'btn-white btn-md waves-effect',
                    confirmButtonClass: 'btn-info btn-md waves-effect waves-light',
                    confirmButtonText: 'Info!'
                });
            });

        </script>
    @endif
@endsection