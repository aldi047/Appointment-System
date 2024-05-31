<li class="nav-item">
    <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p class="text-nowrap">
            Dashboard
            <span class="right badge badge-success">Dokter</span>
        </p>
    </a>
</li>

{{-- <li class="nav-item">
    <a href="/drugs" class="nav-link {{ request()->is('drugs*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-list-alt"></i>
        <p class="text-nowrap">
            Jadwal Periksa
            <span class="right badge badge-success">Dokter</span>
        </p>
    </a>
</li> --}}

<li class="nav-item">
    <a href="/examinations" class="nav-link {{ request()->is('examinations*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-stethoscope"></i>
        <p class="text-nowrap">
            Memeriksa Pasien
            <span class="right badge badge-success">Dokter</span>
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="/history" class="nav-link {{ request()->is('history*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p class="text-nowrap">
            Riwayat Pasien
            <span class="right badge badge-success">Dokter</span>
        </p>
    </a>
</li>

{{-- <li class="nav-item">
    <a href="/drugs" class="nav-link {{ request()->is('drugs*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-md"></i>
        <p class="text-nowrap">
            Profil
            <span class="right badge badge-success">Dokter</span>
        </p>
    </a>
</li> --}}
