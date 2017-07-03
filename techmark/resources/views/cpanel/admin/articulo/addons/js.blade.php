<script src="{{url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>

<script src="{{url('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>

<script>
    // Select2
    $(".select2").select2();
    $('.selectpicker').selectpicker();
    //validation

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
        swal("Actualizacion Exitosa", " ", "success")
        @endif
    });
</script>
@endif

<script src="{{url('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/autoNumeric/autoNumeric.js')}}" type="text/javascript"></script>

<script type="text/javascript">

    jQuery(function($) {
        $('.autonumber').autoNumeric('init');
    });
</script>

<script>
    $(window).load(function(){
        /*
        Todo para Categoria
         */
        $('#addCategoria').click(function () {
            $('#modal_categoria').modal('show');
        });
        $('#categoria_registrar').click(function () {
            $(this).attr("disabled", true);
            var url = "{{route('admin.categoria.store')}}";
            var nombre = $('#categoria_nombre').val();
            var combo = $('#categoria');
            var input= $('#categoria_nombre');
            registrar(url,nombre,combo,this,input);
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
        todo para Marca
        */
        $('#addMarca').click(function () {
            $('#modal_marca').modal('show');
        });
        $('#marca_registrar').click(function () {
            $(this).attr("disabled", true);
            var url = "{{route('admin.marca.store')}}";
            var nombre = $('#marca_nombre').val();
            var combo = $('#marca');
            var input= $('#marca_nombre');
            registrar(url,nombre,combo,this,input);
        });
        /*
         todo para Medida
         */
        $('#addMedida').click(function () {
            $('#modal_medida').modal('show');
        });
        $('#medida_registrar').click(function () {
            $(this).attr("disabled", true);
            var url = "{{route('admin.unidad.store')}}";
            var nombre = $('#medida_nombre').val();
            var combo = $('#medida');
            var input= $('#medida_nombre');
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

    });

</script>
