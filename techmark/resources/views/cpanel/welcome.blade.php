@extends('theme.ubold.layout_cpanel')
@section('content')
    <!-- Page-Title -->
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

    <div class="row">
        <div class="col-lg-12">

            <div class="row">

                <div class="col-md-3">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-inverse  pull-left">
                            <i class="md md-business text-inverse "></i>
                        </div>
                        <div class="text-right">
                            <h3 class="text-dark"><b data-plugin="counterup">{{\App\Sucursal::where('estado',1)->count()}}</b></h3>
                            <p class="text-muted">Sucursales Registradas</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-primary pull-left">
                            <i class="icon-star text-primary"></i>
                        </div>
                        <div class="text-right">
                            <h3 class="text-dark"><b data-plugin="counterup">{{\App\Trabajador::where('estado',1)->count()}}</b></h3>
                            <p class="text-muted">Trabajadores</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-success pull-left">
                            <i class=" icon-phone text-success"></i>
                        </div>
                        <div class="text-right">
                            <h3 class="text-dark"><b data-plugin="counterup">{{\App\User::count()}}</b></h3>
                            <p class="text-muted">Usuarios</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                    <div class="widget">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="external-events" >
                                        <h4><strong>Descripcion Agenda por color</strong></h4>
                                        @foreach(Config('gthusho.colores_categorias_agenda') as $data=>$value)
                                        <div class= " external-event bg-{{$value}}" data-class="bg-primary" >
                                            <i class=" fa fa-move"></i>{{$data}}
                                        </div>
                                        @endforeach
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
    </div> <!-- end row -->


@endsection
@section('css')
    <!--calendar css-->
    <link href="{{url('assets/plugins/fullcalendar/css/fullcalendar.min.css')}}" rel="stylesheet" />

    @if(Session::has('message'))
        <link href="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css">
    @endif
@endsection
@section('js')
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
                        @foreach(\App\Agenda::all() as $item)
                    {
                        title: '{!! $item->asunto !!}',
                        start: '{{\App\Tool::getArrayDate($item->fecha)[0]}}',
                        end:   '{{\App\Tool::getArrayDate($item->fecha)[1]}}',
                        url: '{{route('admin.agenda.edit',$item->id)}}',
                        className: '{{Config::get('gthusho.colores_calendario')[$item->categoria]}}'
                    },
                        @endforeach
                        @foreach(\App\VisitaCotizacion::all() as $item)
                    {
                        title: 'Visitar al cliente : {!! $item->cliente->razon_social !!}',
                        start: '{{$item->fecha }} {{$item->hora}}',
                        end:   '{{$item->fecha }} 23:00:00',
                        url: '{{route('admin.visita.edit',$item->id)}}',
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



    @if(Session::has('message'))
        <script src="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script>
            $(window).load(function(){
                swal("{{Session::get('message')}}");
            });

        </script>
    @endif
    <script src="{{url('assets/plugins/skyicons/skycons.min.js')}}" type="text/javascript"></script>

    <script src="{{url('assets/plugins/peity/jquery.peity.min.js')}}"></script>

    <script src="{{url('assets/pages/jquery.widgets.js')}}"></script>

@endsection