<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon">
                <img class="rounded-circle" src="{{asset('img/logo-poliwangi.png')}}" height="auto" width="50px" alt="...">
                </div>
                <div class="sidebar-brand-text mx-3">Poliwangi - Job Fair</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Nav::isRoute('home') }}">
                <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>{{ __('Dasbor') }}</span>
                </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
        {{ __('Menu') }}
        </div>

        <!-- Nav Item - Profile -->
        <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('profile') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('Profil') }}</span>
                </a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item {{ Nav::isRoute('company-account.index') }}">
                <a class="nav-link" href="{{ route('company-account.index') }}">
                        <i class="fas fa-fw fa-building"></i>
                        <span>{{ __('Akun perusahaan') }}</span>
                </a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item {{ Nav::isRoute('blank') }}">
                <a class="nav-link" href="{{ route('blank') }}">
                        <i class="fas fa-fw fa-book"></i>
                        <span>{{ __('Halaman kosong') }}</span>
                </a>
        </li>

                <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
</ul>
