<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ route(Route::currentRouteName()) }}" method="GET">
        <div class="input-group">
            <input type="text"
                   name="search"
                   class="form-control bg-light border-0 small"
                   placeholder="Cari sesuatu..."
                   aria-label="Search"
                   aria-describedby="basic-addon2"
                   value="{{ request()->input('search') }}"
                   id="searchInput">
                   <div class="input-group-append">
                       <button class="btn btn-primary" type="submit">
                           <i class="fas fa-search fa-sm"></i>
                       </button>
                       @if(request()->has('search') && request('search') !== '')
                           <button type="button" class="btn btn-secondary" id="clearSearch">
                               <i class="fas fa-times fa-sm"></i>
                           </button>
                       @endif
                   </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const form = searchInput.closest('form');
            const clearButton = document.getElementById('clearSearch');

            // Prevent form submission if search input is empty
            form.addEventListener('submit', function(e) {
                if (!searchInput.value.trim()) {
                    e.preventDefault();
                    window.location.href = '{{ route(Route::currentRouteName()) }}';
                }
            });

            // clear button click
            if (clearButton) {
                clearButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = '{{ route(Route::currentRouteName()) }}';
                });
            }

            // Clear when pressing Escape key
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Escape') {
                    window.location.href = '{{ route(Route::currentRouteName()) }}';
                }
            });
        });
    </script>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
                    @if (isset(Auth::user()->avatar))
                        <img src="{{ asset(str_replace('public/', '', 'storage/' . Auth::user()->avatar)) }}" alt="{{ Auth::user()->name }}"width="40" height="40" class="rounded-circle shadow-4-strong">
                    @else
                        <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->username[0] }}"></figure>
                    @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                @if (Auth::user()->role == 'JPC')
                <a class="dropdown-item" href="{{ route('profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Profil') }}
                </a>
                @elseif ( Auth::user()->role == 'COMPANY')
                <a class="dropdown-item" href="{{ route('company-profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Profil') }}
                </a>
                @else
                <a class="dropdown-item" href="{{ route('applicant-profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Profil') }}
                </a>
                @endif
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Keluar') }}
                </a>
            </div>
        </li>

    </ul>

</nav>
