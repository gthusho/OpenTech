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
<script src="{{url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.es.js')}}"></script>
<script>
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        language: 'es'
    });
</script>
<script src="{{url('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/autoNumeric/autoNumeric.js')}}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(function($) {
        $('#xcantidad').autoNumeric('init');
        $('#xprecio').autoNumeric('init');
    });
</script>

<script type="text/javascript">
    window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
</script>

<script>
    $('#changeCombo').on('click', function() {
        $('#ci_2').prop("style", "display: block");
        $('#ci_1').prop("style", "display: none");
        $('#combocliente').prop("required",true);
    });
    $('#changeNit').on('click', function() {
        $('#ci_2').prop("style", "display: none");
        $('#ci_1').prop("style", "display: block");
        $('#combocliente').prop("required",false);
    });
    $('#combocliente').on('change', function() {
        $('#cid').val(this.value);
    });
    function genItem(item) {
        $('#pproducto').val(item['producto']);
        $('#ptalla').val(item['talla']);
        $('#pmaterial').val(item['material']);
        $('#pprecio').val(item['precio']);
        $('#pcosto').val(item['costo']);
        $('#pid').val(item['producto_id']);
        $('#ptallaid').val(item['talla_id']);
        $('#pmaterialid').val(item['material_id']);
        $('#pelprecio').val(item['elprecio']);
        $('#xdescripcion').val(item['xdescripcion']);
        $('#xprecio').val(item['xprecio']);
        $('#xcantidad').val(item['xcantidad']);

    }
    function genCliente(item) {
        $('#crazon').val(item['razon_social']);
        $('#cid').val(item['id']);
    }
    function clean() {
        $('.cleanclean').val("");
    }
    function workAjax(_url,_data,_type) {
        $.ajax({
            url: _url,
            type: 'GET',
            data: { data: _data,type:_type} ,
            success: function (json) {
                genItem(json);
                onOffBtnCart(true);
            },
            error: function (data) {
                clean();
                onOffBtnCart(false);
                alert("El codigo no Existe!!");
            }
        });
    }
    function workAjaxClose(_url,_data,_type) {
        $.ajax({
            url: _url,
            type: 'GET',
            data: { data: _data,type:_type} ,
            success: function (json) {
                genItem(json);
                onOffBtnCart(true);
                $('#modal_search').modal('hide');
            },
            error: function (data) {
                clean();
                onOffBtnCart(false);
                alert("El codigo no Existe!!");
            }
        });
    }
    /*
    todo para registrar cliente
     */
    function workAjaxNit(_url,_data) {
        $.ajax({
            url: _url,
            type: 'GET',
            data: { data: _data} ,
            success: function (json) {
                genCliente(json);
            },
            error: function (data) {
                clean();
                RegistrarCliente(_data);
            }
        });
    }
    function workAjaxCliente(_url,_nit,_nombre) {
        $.ajax({
            url: _url,
            type: 'POST',
            data: { nit: _nit,nombre:_nombre} ,
            success: function (json) {
                $('.mAlert').html("");
                $('.mAlert').removeClass('alert alert-danger');
                $('#xnit').val(json['nit']);
                $('#crazon').val(json['razon_social']);
                $('#cid').val(json['id']);
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
    }
    $('#cliente_registrar').click(function () {
        var nit = $('#xxNit').val();
        var nombre = $('#xxNombreCliente').val();
        var url = "{{route('registrarCliente')}}";
        workAjaxCliente(url,nit,nombre);
    });
    /*
    fin registrar cliente
     */
    function RegistrarCliente(_data) {

        $('#modal_cliente').modal('show');
        $('#modal_cliente').on('shown.bs.modal', function () {
            $('#xxNit').val(_data);
            $('#xxNombreCliente').focus();
        });
    }
    function onOffBtnCart($xx) {
        if(!$xx){
            $('#AddItemCart').attr('disabled', true);
        }else {
            $('#AddItemCart').removeAttr('disabled');
        }
    }
    $('#ClearItemCart').click(function () {
        onOffBtnCart(false);
        clean();
    });
    $(window).load(function(){
        $('#AddItemCart').attr('disabled', true);
    });
    $("#xnit").on('keyup', function (e) {
        var nit = $(this).val();
        var url = "{{route('getClienteForVenta')}}";
        if (e.keyCode == 13) {
            workAjaxNit(url,nit)
        }
    });


    $('td').css('cursor','crosshair');
    $(".rows").click(function (){
        var codigo = $(this).attr('data-id');
        var url = "{{route('productoById','GTHUSHO')}}";
        url = url.replace('GTHUSHO',codigo);
        workAjax(url,codigo,"id")
    });

    $('#btnConfirmar').click(function () {
        var isGood=confirm('Esta Seguro de Continuar?');
        if (isGood) {
            var h1 = $('#cid').val();
            var h2 = $('#Csucursal').val();
            var h3 = $('#datepicker-autoclose').val();
            $('#HCcliente').val(h1);
            $('#HCsucursal').val(h2);
            $('#HCfecha').val(h3);
            $('#confirmar').submit();
        }
    });
    $('#btnActualizar').click(function () {
        clean();
        $('#form-cotizacion-producto').submit();
    });

    $('#Search').click(function () {

        $('#modal_search').modal('show');
        $('#modal_search').on('shown.bs.modal', function () {
            $('#xkeySearch').val("");
            $('#xkeySearch').focus();
        });
    });
    function workAjaxListItems(_url,_data) {
        $.ajax({
            url: _url,
            type: 'GET',
            data: { data: _data} ,
            success: function (json) {
                $("#tablaRows").find("tr").remove();
                $("#tablaRows").append(json);
            },
            error: function (data) {
                $("#tablaRows").find("tr").remove();
                alert("No se Encontraron productos!!");
            }
        });
    }
    $('#xkeySearch').on('keyup',function (e) {
        var key = $(this).val();
        var url = "{{route('getListProductosBase')}}";
        if (e.keyCode == 13) {
            workAjaxListItems(url,key);
        }
    });
  function genListSubData(key) {
      var codigo = key;
      var url = "{{route('showDetalleProducto')}}";
      workAjaxClose(url,codigo,"id");
  }
</script>
