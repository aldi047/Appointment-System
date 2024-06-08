<li class="nav-item">
    <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p class="text-nowrap">
            Dashboard
            <span class="right badge badge-info">Pasien</span>
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="/reg-polyclinic" class="nav-link {{ request()->is('reg-polyclinic*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-building"></i>
        <p class="text-nowrap">
            Poli
            <span class="right badge badge-info">Pasien</span>
        </p>
    </a>
</li>
