@extends('adminlte::master')
@include('footer')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
    <link rel="stylesheet" href={{ asset('assets/css/toastr.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/select2.min.css') }}>
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Preloader Animation (fullscreen mode) --}}
        @if($preloaderHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
    <script src={{asset('assets/js/toastr.min.js')}}></script>
    <script src={{asset('assets/js/select2.min.js')}}></script>
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 4000;
            @if (session()->has('success'))
                toastr.success("{{ Session::get('success') }}", 'BERHASIL');
            @elseif (session()->has('info'))
                toastr.info("{{ Session::get('info') }}", 'INFORMASI');
            @elseif (session()->has('error'))
                toastr.error("{{ Session::get('error') }}", 'GAGAL');
            @endif
        });
    </script>
@stop
