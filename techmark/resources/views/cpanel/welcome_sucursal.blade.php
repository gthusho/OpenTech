@extends('theme.ubold.layout_cpanel')
@section('content')

    @if($atm->check()==True && $atm->getEstado()=='p')

    @else
        <div class="row">
            <div class="col-sm-12">

                <h4 class="page-title">Calendario</h4>
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">App</a></li>
                    <li class="active">Calendario</li>
                </ol>
            </div>
        </div>
    @endif
    <div class="row">
        @if($atm->check())
             @include('cpanel.admin.caja.partials.general')
        @else
            <div class="row">
                <div class="col-lg-12">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="widget">
                                <div class="widget-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div id="external-events" >
                                                <h4><strong>Descripcion Agenda por color</strong></h4>
                                                <div class= " external-event bg-purple" data-class="bg-primary" >
                                                    <i class=" fa fa-move"></i>Visita Tomar Medidas
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-md-9">
                            <div class="card-box">
                                <div id="calendar"></div>
                            </div>
                        </div> <!-- end col -->
                    </div>  <!-- end row -->
                </div>
                <!-- end col-12 -->
            </div>
        @endif
    </div>
@endsection
@section('css')
    @if(Session::has('message'))
        <link href="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css">
    @endif
    <link href="{{url('assets/plugins/fullcalendar/css/fullcalendar.min.css')}}" rel="stylesheet" />
@endsection
@section('js')
    @if(Session::has('message'))
        <script src="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script>
            $(window).load(function(){
                swal("{{Session::get('message')}}");
            });

        </script>
    @endif
        <script src="{{url('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

        <!-- BEGIN PAGE SCRIPTS -->
        <script src="{{url('assets/plugins/moment/moment.js')}}"></script>
        <script src='{{url('assets/plugins/fullcalendar/js/fullcalendar.min.js')}}'></script>
        <script src='{{asset('es.js')}}'></script>
        <script>
            $(document).ready(function() {
                var initialLangCode = 'es';
                var today = new Date($.now());
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    defaultDate: today,
                    lang: initialLangCode,
                    buttonIcons: false, // show the prev/next text
                    weekNumbers: false,
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events: [
                            @foreach(\App\VisitaCotizacion::all() as $item)
                        {
                            title: 'Visitar al cliente : {!! $item->cliente->razon_social !!}',
                            start: '{{$item->fecha }} {{$item->hora}}',
                            end:   '{{$item->fecha }} 23:00:00',
                            url: '{{route('s.visita.edit',$item->id)}}',
                            className: 'bg-purple'
                        },
                        @endforeach
                    ]
                });

                // build the language selector's options
                $.each($.fullCalendar.langs, function(langCode) {
                    $('#lang-selector').append(
                        $('<option/>')
                            .attr('value', langCode)
                            .prop('selected', langCode == initialLangCode)
                            .text(langCode)
                    );
                });

                // when the selected option changes, dynamically change the calendar option
                $('#lang-selector').on('change', function() {
                    if (this.value) {
                        $('#calendar').fullCalendar('option', 'lang', this.value);
                    }
                });
            });

        </script>

        <script src="{{url('assets/plugins/skyicons/skycons.min.js')}}" type="text/javascript"></script>

        <script src="{{url('assets/plugins/peity/jquery.peity.min.js')}}"></script>

        <script src="{{url('assets/pages/jquery.widgets.js')}}"></script>

@endsection