<li class="nav-item">
    <a href="/" class="nav-link {{ (request()->is('/')) ? 'active' : '' }}">
    <i class="nav-icon fas fa-th"></i>
    <p class="text-nowrap">
        Dashboard
        <span class="right badge badge-danger">Admin</span>
    </p>
    </a>
</li>

<li class="nav-item">
    <a href="/drugs" class="nav-link {{ (request()->is('drugs*')) ? 'active' : '' }}">
    <i class="nav-icon fas fa-th"></i>
    <p class="text-nowrap">
        Obat
        <span class="right badge badge-danger">Admin</span>
    </p>
    </a>
</li>



