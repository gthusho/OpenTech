@if(Session::has('tiket'))
    <script>
        var pdf_url = "{!! Session::get('tiket') !!}";
        printJS(pdf_url)
    </script>
@endif
