<li class="nav-item">
    <a href="/dashboard" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p class="text-nowrap">
            Dashboard
            <span class="right badge badge-danger">Admin</span>
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="/doctors" class="nav-link {{ request()->is('doctors*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-md"></i>
        <p class="text-nowrap">
            Dokter
            <span class="right badge badge-danger">Admin</span>
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="/patients" class="nav-link {{ request()->is('patients*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-user"></i>
        <p class="text-nowrap">
            Pasien
            <span class="right badge badge-danger">Admin</span>
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="/polyclinics" class="nav-link {{ request()->is('polyclinics*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-building"></i>
        <p class="text-nowrap">
            Poli
            <span class="right badge badge-danger">Admin</span>
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="/drugs" class="nav-link {{ request()->is('drugs*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="nav-icon mb-1 bi bi-capsule" viewBox="0 0 16 16">
            <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429z"/>
          </svg>
        <p class="text-nowrap">
            Obat
            <span class="right badge badge-danger">Admin</span>
        </p>
    </a>
</li>

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
