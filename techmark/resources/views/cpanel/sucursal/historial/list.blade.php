@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <br>
    <div class="row">
      <div class="col-sm-12">
          @include('cpanel.sucursal.historial.partials.search')
      </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="table-rep-plugin">
                    <div class="table-responsive" data-pattern="priority-columns">
                        @include('cpanel.sucursal.historial.partials.table')
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="pull-left">
            {{$historial->appends(Request::only(['s']))->render()}}
        </div>
    </div>
@endsection
@section('css')
    <link href="{{url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
    <script src="{{url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>

    <script src="{{url('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>

    <script>
        $(".select2").select2();
    </script>
@endsection