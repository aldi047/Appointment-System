<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>

                @if (Auth::guard('admin')->check())
                    @include('adminlte::partials.sidebar.admin-sidebar')
                @elseif (Auth::guard('doctor')->check())
                    @include('adminlte::partials.sidebar.doctor-sidebar')
                @elseif (Auth::guard('patient')->check())
                    @include('adminlte::partials.sidebar.patient-sidebar')
                @endif
            </ul>
        </nav>
    </div>

</aside>
