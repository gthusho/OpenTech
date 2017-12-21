<script src="{{url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>

<script src="{{url('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>

<script>
    // Select2
    $(".select2").select2();
    $('.selectpicker').selectpicker();
    //validation

    $('#addCliente').click(function () {
        $('#modal_cliente').modal('show');
        $('#modal_cliente').on('shown.bs.modal', function () {
            $('#xxNit').focus();
        });
    });
    $('#cliente_registrar').click(function () {
        $(this).attr("disabled", true);
        var url = "{{route('admin.cliente.store')}}";
        var nit = $('#xxNit').val();
        var nombre = $('#xxNombreCliente').val();
        var combo = $('#cliente');
        registrar(url,nombre,nit,combo,this);
    });

    function registrar(_url,_name,_nit,_combo,_boton) {
        $.ajax({
            url: _url,
            type: 'POST',
            data: { razon_social: _name, nit: _nit} ,
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