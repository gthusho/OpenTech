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
<script>
    $('#ciudad').on('change', function() {
        var _url = "{{route('almacenes_disponibles')}}";
        var _ciudad = this.value;
        var _sucursal = 0;
        @if(Request::segment(4)=='edit')
            _sucursal = "{{$sucursal->id}}";
        @endif
        $.ajax({
            url: _url,
            type: 'GET',
            data: { ciudad: _ciudad,sucursal:_sucursal} ,
            success: function (json) {
                $('#depositos').html()
                $('#depositos').html(json);
            },
            error: function (data) {
                alert("Opss.. ocurrrio algo inesperado por favor actualiza tu navegador f5");
            }
        });

    });
</script>