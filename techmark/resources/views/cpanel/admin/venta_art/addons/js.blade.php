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

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>

<script type="text/javascript">
    window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
</script>

<script>
    function genItem(item) {
        $('#anombre').val(item['nombre']);
        $('#acategoria').val(item['categoria']);
        $('#amarca').val(item['marca']);
        $('#amaterial').val(item['material']);
        $('#aprecio1').val(item['precio1']);
        $('#aprecio2').val(item['precio2']);
        $('#aprecio3').val(item['precio3']);
        $('#aprecio4').val(item['precio4']);
        $('#aprecio5').val(item['precio5']);
        $('#astock').val(item['stockIventario']);
        $('#aid').val(item['id']);
        $('#amedida').val(item['unidad']);
        $('#xcantidad').val(item['xcantidad']);

        if(item['dp']!='' || item['dp']!= null){
            $('.cRemove').attr('checked', false);
            $('#'+item['dp']).prop("checked", true);
        }

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
                @if(Request::segment(5)=='edit')
                RegistrarClienteEdit(_data);
                @else
                RegistrarCliente(_data);
                @endif
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
    function RegistrarClienteEdit(_data) {
        $('#xxNit').val(_data);
        $('#modal_cliente').modal('show');
        $('#modal_cliente').on('shown.bs.modal', function () {
            $('#xxNombreCliente').focus();
        });
    }
    function RegistrarCliente(_data) {
        $('#modal_venta_ok')
            .modal('hide')
            .on('hidden.bs.modal', function (e) {
                $('#xxNit').val(_data);
                $('#modal_cliente').modal('show');
                $('#modal_cliente').on('shown.bs.modal', function () {
                    $('#xxNombreCliente').focus();
                });
                $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
            });

    }

    $("#modal_cliente").on("hidden.bs.modal", function () {
        @if(Request::segment(4)!='edit') // solo funciono si no estoy editando
        $('#modal_venta_ok').modal('show');
        @endif
    });
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

    $("#xcodigo").on('keyup', function (e) {
        var codigo = $(this).val();
        var url = "{{route('getArticuloForVenta')}}";
        if (e.keyCode == 13) {
            workAjax(url,codigo,"codigo");

        }
    });
    $("#xcodigobarra").on('keyup', function (e) {
        var codigo = $(this).val();
        var url = "{{route('getArticuloForVenta')}}";
        if (e.keyCode == 13) {
            workAjax(url,codigo,"barra")
        }
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
        var url = "{{route('showArticleByEgresoId','GTHUSHO')}}";
        url = url.replace('GTHUSHO',codigo);
        workAjax(url,codigo,"id")
    });

    $('#btnConfirmar').click(function () {
        var isGood=confirm('Esta Seguro de Continuar?');
        if (isGood) {
            $('#confirmar').submit();
        }
    });
    $('#showModalVenta').click(function () {
        $('#modal_venta_ok').modal('show');
        $('#modal_venta_ok').on('shown.bs.modal', function () {
            if($('#cid').val()=="")
                $('#xnit').focus();
        });
    });
    $('#btnActualizar').click(function () {
        clean();
        $('#form-venta-articulo').submit();
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
                alert("No se Encontraron articulos!!");
            }
        });
    }
    $('#xkeySearch').on('keyup',function (e) {
        var key = $(this).val();
        var url = "{{route('getListArticulos')}}";
        if (e.keyCode == 13) {
            workAjaxListItems(url,key);
        }
    });
  function genListSubData(key) {
      var codigo = key;
      var url = "{{route('showArticle')}}";
      workAjaxClose(url,codigo,"id");

  }
    function fncRestar(){
        var numero1 = Number({!! $venta->totalPrecio() !!});
        var numero2 = Number(document.getElementById("abono").value);
        var cambio = numero2 - numero1;
        if(cambio<0){

            if($('#tipo_pago').val()=="Credito"){
                document.getElementById("cambio").value = "A Credito " + (cambio*-1) + " Bs.";
                onOffsuperStart(true);
            }else {
                document.getElementById("cambio").value = "Efectivo Insuficiente ";
                onOffsuperStart(false);
            }

        }else {
            onOffsuperStart(true);
            document.getElementById("cambio").value = cambio  + " Bs.";
        }


    }
    $("#tipo_pago").on("change", function(e) {
        fncRestar();
    });
    function onOffsuperStart($xx) {
        if(!$xx){
            $('#superStart').attr('disabled', true);
        }else {
            $('#superStart').removeAttr('disabled');
        }
    }
    $("#abono").on('input',function () {
        fncRestar();
    });
</script>
