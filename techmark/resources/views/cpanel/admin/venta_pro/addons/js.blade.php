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
    $(window).load(function(){
        @if(Session::has('message'))
        swal("Actualizacion Exitosa", " ", "success")
        @endif
    });
</script>
@endif
<script src="{{url('assets/plugins/moment/moment.js')}}"></script>

<script src="{{url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.es.js')}}"></script>
<script src="{{url('assets/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{url('assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/es.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>

<script>
    jQuery(document).ready(function() {
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        moment.locale('es');
        $('.input-daterange-timepicker').daterangepicker({
            timePicker: false,
            timePickerIncrement: 30,
            locale: {
                format: 'YYYY/MM/DD'
            },

            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-default',
            cancelClass: 'btn-white'
        });
    });
</script>
<script src="{{url('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/autoNumeric/autoNumeric.js')}}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(function($) {
        $('#xcantidad').autoNumeric('init');
    });
</script>

<script type="text/javascript">
    window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
</script>

<script>
    $("#atallas").on("change", function(e) {
        var id_ = $(this).val();

        var url = "{{route('priceByIdProduct')}}";

        $.post(url, { id:id_}, function(data){
            genPrice(data);
            onOffBtnCart(true);
        });
    });
    function genPrice(item) {
        $('#aprecio1').val(item['precio1']);
        $('#aprecio2').val(item['precio2']);
        $('#aprecio3').val(item['precio3']);
        $('#pstock').val(item['stock']);
        $('#talla_id').val(item['talla_id']);
    }
    function genItem(item) {
        $('#Pnombre').val(item['nombre']);
        $('#pimagen').attr("src",item['imagen']);
        $('#aprecio1').val(item['precio1']);
        $('#aprecio2').val(item['precio2']);
        $('#aprecio3').val(item['precio3']);
        $('#pstock').val(item['stock']);
        $('#producto_id').val(item['producto_id']);
        $('#talla_id').val(item['talla_id']);
        $('#xcantidad').val(item['xcantidad']);

        var tallas = item['tallas'];
        $("#atallas").html('');
        $("#atallas").html(tallas);
        $("#atallas").trigger('change');

        if(item['dp']!='' || item['dp']!= null){
            $('.cRemove').attr('checked', false);
            $('#'+item['dp']).prop("checked", true);
        }

    }
    function clean() {
        var img = "{{url('system/productos/defaultstore.jpg')}}";
        $('#pimagen').attr("src",img);
        $('.cleanclean').val("");
        $("#atallas").html("");
        $("#atallas").trigger('change');

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
        var url = "{{route('productByCode')}}";
        if (e.keyCode == 13) {
            workAjax(url,codigo,"codigo")
        }
    });
    $("#xcodigobarra").on('keyup', function (e) {
        var codigo = $(this).val();
        var url = "{{route('productByCode')}}";
        if (e.keyCode == 13) {
            workAjax(url,codigo,"barra")
        }
    });
    @if(Request::segment(5)!='edit')
        $('td').css('cursor','crosshair');
    $(".rows").click(function (){
        var codigo = $(this).attr('data-id');
        var url = "{{route('ventaProductobyRow')}}";
        workAjax(url,codigo,"id")
    });
   @endif
    $('#btnConfirmar').click(function () {
        var isGood=confirm('Esta Seguro de Continuar?');
        if (isGood) {
            $('#confirmar').submit();
        }
    });
    $('#btnActualizar').click(function () {
        clean();
        $('#form-produccion').submit();
    });

    $('#Search').click(function () {
        $('#modal_search').modal('show');
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
                alert("No se Encontraron Productos!!");
            }
        });
    }
    $('#xkeySearch').on('keyup',function (e) {
        var key = $(this).val();
        var url = "{{route('getListProductos')}}";
        if (e.keyCode == 13) {
            workAjaxListItems(url,key);
        }
    });
  function genListSubData(key) {
      var codigo = key;
      var url = "{{route('showProductoSearch')}}";
      workAjax(url,codigo,"id");
  }
  /*
  cliente
   */
    $("#xnit").on('keyup', function (e) {
        var nit = $(this).val();
        var url = "{{route('getClienteForVenta')}}";
        if (e.keyCode == 13) {
            workAjaxNit(url,nit)
        }
    });
    /*
     abro el modal confirmar venta
     */
    $('#showModalVenta').click(function () {
        $('#modal_venta_ok').modal('show');
        $('#modal_venta_ok').on('shown.bs.modal', function () {
            if($('#cid').val()=="")
                $('#xnit').focus();
        });
    });
    /*
     abro el modal confirmar venta
     */
    /*
    * modificaciones para modals
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
        @if(Request::segment(5)!='edit') // solo funciono si no estoy editando
       $('#modal_venta_ok').modal('show');
       @endif
    });
    /*
     * fin modificaciones para modals
     */
    function genCliente(item) {
        $('#crazon').val(item['razon_social']);
        $('#cid').val(item['id']);
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
    $('#btnActualizar').click(function () {
        clean();
        $('#form-venta-producto').submit();
    });
    /*
    calculo de cambio
     */
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
