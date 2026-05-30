<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('landing') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-tasks"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="color: white;">M-TUGAS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Menu Admin</div>

    <!-- Data User -->
    <li class="nav-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data User</span>
        </a>
    </li>

    <!-- Data Tugas -->
    <li class="nav-item {{ request()->routeIs('admin.tugas.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.tugas.index') }}">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Data Tugas</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
