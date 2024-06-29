<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('landing') }}">
                <div class="sidebar-brand-icon">
                        <img class="rounded-circle" src="{{asset('img/logo-poliwangi.png')}}" height="auto" width="50px" alt="...">
                        <img src="{{asset('img/poliwangi-white.svg')}}" alt="Job Fair Logo" width="100" height=auto class="d-inline-block align-text-top">      
                </div>
                
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
        
        @if ( Auth::user()->role == 'JPC')
        <!-- Nav Item - Profile -->
        <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('profile') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('Profil') }}</span>
                </a>
        </li>
        <!-- Nav Item Akun Perusahaan -->
        <li class="nav-item {{ Nav::isRoute('company-account.index') }}">
                <a class="nav-link" href="{{ route('company-account.index') }}">
                        <i class="fas fa-fw fa-building"></i>
                        <span>{{ __('Akun perusahaan') }}</span>
                </a>
        </li>
        <!-- Nav Item -->
        <li class="nav-item {{ Nav::isRoute('event-management.index') }}">
                <a class="nav-link" href="{{ route('event-management.index') }}">
                        <i class="fas fa-fw fa-calendar"></i>
                        <span>{{ __('Manajemen Kegiatan') }}</span>
                </a>
        </li>
        @elseif ( Auth::user()->role == 'COMPANY')
        <!-- Nav Item Lowongan -->
        <li class="nav-item {{ Nav::isRoute('job-management.index') }}">
                <a class="nav-link" href="{{ route('job-management.index') }}">
                        <i class="fas fa-fw fa-clipboard"></i>
                        <span>{{ __('Manajemen Lowongan') }}</span>
                </a>
        </li>
        <!-- Nav Item Lamaran -->
        <li class="nav-item {{ Nav::isRoute('job-applicantion.index') }}">
                <a class="nav-link" href="{{ route('job-application.index') }}">
                        <i class="fas fa-fw fa-list"></i>
                        <span>{{ __('Manajemen Lamaran') }}</span>
                </a>
        </li>
        @else
        <!-- Nav Item - Profile -->
        <li class="nav-item {{ Nav::isRoute('applicant-profile') }}">
                <a class="nav-link" href="{{ route('applicant-profile') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('Profil') }}</span>
                </a>
        </li>
        <!-- Nav Item Lamaran User -->
        <li class="nav-item {{ Nav::isRoute('my-job-application') }}">
                <a class="nav-link" href="{{ route('my-job-application') }}">
                        <i class="fas fa-fw fa-book"></i>
                        <span>{{ __('Lamaranku') }}</span>
                </a>
        </li>
        @endif        

        <!-- Nav Item -->
        <li class="nav-item {{ Nav::isRoute('landing') }}">
                <a class="nav-link" href="{{ route('landing') }}">
                        <i class="fas fa-fw fa-book"></i>
                        <span>{{ __('Jelajahi Job Fair') }}</span>
                </a>
        </li>

                <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
</ul>