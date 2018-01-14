<script src="{{url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>

<script src="{{url('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>

<script>
    // Select2
    $(".select2").select2();
    $('.selectpicker').selectpicker();
    //validation

</script>
<script src="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>

<script>
    $(window).load(function(){
        @if(Session::has('message'))
        swal("{!! Session::get('message') !!} ", "", "success");
        @endif
    });

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function isNumberKeyDec(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
            return false;
        return true;
    }
</script>
<script src="{{url('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/autoNumeric/autoNumeric.js')}}" type="text/javascript"></script>
<script>

</script>

<script>
    $(window).load(function(){
        /*
         Todo para Producto Base
         */
        $('#addProducto').click(function () {
            $('#modal_producto').modal('show');
        });
        $('#prodbase_registrar').click(function () {
            $(this).attr("disabled", true);
            var url = "{{route('admin.prodbase.store')}}";
            var nombre = $('#prodbase_descripcion').val();
            var combo = $('#prodbase');
            var input= $('#prodbase_descripcion');
            registrardesc(url,nombre,combo,this,input);
        });
        /*
         Todo para Material
         */
        $('#addMaterial').click(function () {
            $('#modal_material').modal('show');
        });
        $('#material_registrar').click(function () {
            $(this).attr("disabled", true);
            var url = "{{route('admin.material.store')}}";
            var nombre = $('#material_nombre').val();
            var combo = $('#material');
            var input= $('#material_nombre');
            registrar(url,nombre,combo,this,input);
        });
        /*
         todo para Talla
         */
        $('#addTalla').click(function () {
            $('#modal_talla').modal('show');
        });
        $('#talla_registrar').click(function () {
            $(this).attr("disabled", true);
            var url = "{{route('admin.talla.store')}}";
            var nombre = $('#talla_nombre').val();
            var combo = $('#talla');
            var input= $('#talla_nombre');
            registrar(url,nombre,combo,this,input);
        });
        /*
         Super Metodo ajax
         */
        function registrar(_url,_name,_combo,_boton,_input) {
            $.ajax({
                url: _url,
                type: 'POST',
                data: { nombre: _name} ,
                success: function (json) {
                    $('.mAlert').html("");
                    $('.mAlert').removeClass('alert alert-danger');
                    $(_combo).html('');
                    $(_combo).html(json);
                    $(_combo).trigger('change');
                    $('.mAlert').addClass('alert alert-success');
                    $('.mAlert').html("Registro Exitoso");
                    $(_input).val('');
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

        }

        function registrardesc(_url,_name,_combo,_boton,_input) {
            $.ajax({
                url: _url,
                type: 'POST',
                data: { descripcion: _name} ,
                success: function (json) {
                    $('.mAlert').html("");
                    $('.mAlert').removeClass('alert alert-danger');
                    $(_combo).html('');
                    $(_combo).html(json);
                    $(_combo).trigger('change');
                    $('.mAlert').addClass('alert alert-success');
                    $('.mAlert').html("Registro Exitoso");
                    $(_input).val('');
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

        }

    });

</script>