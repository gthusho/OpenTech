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
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        language: 'es'
    });
</script>
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
    jQuery(function($) {
        $('#Pprecio').autoNumeric('init');
        $('#PSaldo').autoNumeric('init');
    });
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
            workAjax(url,codigo,"codigo")
        }
    });
    $("#xcodigobarra").on('keyup', function (e) {
        var codigo = $(this).val();
        var url = "{{route('getArticuloForVenta')}}";
        if (e.keyCode == 13) {
            workAjax(url,codigo,"barra")
        }
    });

    $('td').css('cursor','crosshair');
    $(".rows").click(function (){
        var codigo = $(this).attr('data-id');
        var url = "{{route('clientes.showArticleByProduccionId','GTHUSHO')}}";
        url = url.replace('GTHUSHO',codigo);
        workAjax(url,codigo,"id")
    });
    $('#btnConfirmar').click(function () {
        var isGood=confirm('Esta Seguro de Continuar?');
        if (isGood) {
            var h1 = $('#Psucursal').val();
            var h2 = $('#Ptrabajador').val();
            var h3 = $('#Pcliente').val();
            var h4 = $('#Pfecha').val();
            var h5 = $('#Pdestino').val();
            var h6 = $('#Pprecio').val();
            var h7 = $('#Padelando').val();
            $('#HPsucursal').val(h1);
            $('#HPtrabajador').val(h2);
            $('#HPcliente').val(h3);
            $('#HPfecha').val(h4);
            $('#HPdestino').val(h5);
            $('#HPprecio').val(h6);
            $('#HPadelando').val(h7);
            $('#confirmar').submit();
        }
    });
    $('#btnActualizar').click(function () {
        clean();
        $('#form-produccion').submit();
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
</script>
<script>
    function parseCurrency( num ) {
        return parseFloat( num.replace( /,/g, '') );
    }

    $("#Padelando").on("keyup keypress change paste", function(){
        var saldo = $('#Pprecio').val();
        var ret = parseCurrency(saldo) - parseCurrency(($(this).val()));
        $("#PSaldo").val(ret);
    })
</script>