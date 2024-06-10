<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #004878;">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
        <img class="rounded-circle" src="{{asset('admin/img/logo-poliwangi.png')}}" height="auto" width="50px" alt="...">
        <!-- <i class="fas fa-laugh-wink"></i> -->
    </div>
    <div class="sidebar-brand-text mx-3">
        <img src="{{asset('admin/img/poliwangi-white.svg')}}" height="auto" width="126px"" alt="">
    </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="{{route('dasbor')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>DASHBOARD</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-user"></i>
        <span>LAMARAN</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('lowongan')}}">
        <i class="fas fa-briefcase"></i> 
        <span>LOWONGAN</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>