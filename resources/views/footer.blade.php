@section('footer')
    <div class="float-right d-none d-sm-inline">
        Aldi Azmi Arfian
    </div>
    <strong>Copyright &copy; 2024</strong> Bengkel Koding
@stop

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stop

@section('js')
    @yield('javascript')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>

        $(document).ready(function() {
            toastr.options.timeOut = 4000;
            @if (session()->has('success'))
                toastr.success("{{ Session::get('success') }}", 'BERHASIL');
            @elseif (session()->has('info'))
                toastr.info("{{ Session::get('info') }}", 'BERHASIL');
            @elseif (session()->has('error'))
                console.log('error');
                toastr.error("{{ Session::get('error') }}", 'GAGAL');
            @endif
        });
    </script>
@stop
