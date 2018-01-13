<script src="{{url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js')}}" type="text/javascript"></script>

<script>
    // Select2
    $(".select2").select2();
    $('.selectpicker').selectpicker();
    //validation

    function todo(x) {
        if(x.checked) {
            for (i=0; i<document.getElementsByName("ch").length; i++)
                document.getElementsByName("ch")[i].checked = true;
        }
        else{
            for (i=0; i<document.getElementsByName("ch").length; i++)
                document.getElementsByName("ch")[i].checked = false;
        }
    }

    function confirmar() {
        var len=document.getElementsByName("ch").length;
        var ids=[];
        var c=0;
        @if(Auth::user()->rol=='1')
            var url="{{route('admin.visita.detalle.show','Open')}}";
        @else
            var url="{{route('s.visita.detalle.show','Open')}}";
        @endif
        for (i=0; i<len; i++) {
            if (document.getElementsByName("ch")[i].checked == true) {
                ids[c] = document.getElementsByName("ch")[i].getAttribute('id');
                c++;
            }
        }
        $.ajax({
            url: url,
            type: 'GET',
            data: { detalles: ids} ,
            success: function (json) {
                location.reload();
            },
            error: function (data) {
                alert('fallo ' + ids)
            }
        });
    }

    $('#addCliente').click(function () {
        $('#modal_cliente').modal('show');
        $('#modal_cliente').on('shown.bs.modal', function () {
            $('#xxNit').focus();
        });
    });
    $('#cliente_registrar').click(function () {
        $(this).attr("disabled", true);
        var url = "{{route('registrarCliente')}}";
        var nit = $('#xxNit').val();
        var nombre = $('#xxNombreCliente').val();
        var combo = $('#cliente');
        var telefono = $('#xtelefono').val();
        var direccion = $('#xdireccion').val();
        var email = $('#xemail').val();
        registrar(url,nombre,nit,combo,this,telefono,direccion,email);
    });

    function registrar(_url,_name,_nit,_combo,_boton,_telefono,_direccion,_email) {
        $.ajax({
            url: _url,
            type: 'POST',
            data: { nit: _nit,nombre:_name,telefono:_telefono,direccion:_direccion,email:_email ,combo:"si"} ,
            success: function (json) {
                $('.mAlert').html("");
                $('.mAlert').removeClass('alert alert-danger');
                $(_combo).html('');
                $(_combo).html(json);
                $(_combo).trigger('change');
                $('.mAlert').addClass('alert alert-success');
                $('.mAlert').html("Registro Exitoso");
                $('.limpiar').val('');
                $(_boton).removeAttr("disabled");
            },
            error: function (data) {
                var errors = '';
                for(datos in data.responseJSON){
                    errors += data.responseJSON[datos] + '<br>';
                }
                $('.mAlert').addClass('alert alert-danger');
                $('.mAlert').html(errors);
                $(_boton).removeAttr("disabled");
            }
        });
    };
</script>
@if(Request::segment(4)=='edit')
<script src="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
<script>
    $('#btn-delete').click(function (e) {
        swal({
            title: "Esta usted Seguro?",
            text: "No podrás recuperar esta informacion",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Estoy seguro!",
            cancelButtonText: "No, Cancelar !",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $('#form-delete').submit()
            } else {
                swal("Cancelado", "Su informacion esta segura", "error");
            }
        });
    });
</script>
<script>
    $(window).load(function(){
        @if(Session::has('message'))
        swal('{!! Session::get('message') !!}', " ", "success");
        @endif
    });
</script>
@endif
<script src="{{url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.es.js')}}"></script>
<script>
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        language: 'es',
    });

    jQuery('#clockpicker').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
</script>
<script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA0D_4taQugJG4JHAVIZXe0XZvkY24rJx8&sensor=false&libraries=places'></script>
<script  src="{{url('map/locationpicker.jquery.min.js')}}"></script>
<script>
    var x ;
    var y;
    var _location;
    @if(Request::segment(4)=='edit')
        x = {{$visita->x}};
        y = {{$visita->y}};
    _location = '{{$visita->direccion}}';
    @else
        x = -19.047677;
    y = -65.25894019999998;
    _location = 'Casco Viejo';
    @endif
    $('#map_canvas').locationpicker({
        location: {
            latitude: x,
            longitude: y
        },
        radius: 0,
        zoom: 15,
        mapOptions: {
            markerTitle:_location
        },

        inputBinding: {
            latitudeInput: $('#x'),
            longitudeInput: $('#y'),
            locationNameInput: $('#us3-address')
        },
        enableAutocomplete: true
        //  markerIcon: '{{url('map-marker-2-xl.png')}}'

    });
</script>