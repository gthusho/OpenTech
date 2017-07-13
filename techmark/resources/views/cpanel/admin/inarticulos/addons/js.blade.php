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
            swal("Actualizacion Exitosa", " ", "success");
            @endif
        });
    </script>
@endif
<script src="{{url('assets/plugins/moment/moment.js')}}"></script>

<script src="{{url('assets/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
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
                format: 'DD/MM/YYYY'
            },

            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-default',
            cancelClass: 'btn-white'
        });
    });
</script>
<script src="{{url('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.js')}}" type="text/javascript"></script>
<script src="{{url('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js')}}"></script>
