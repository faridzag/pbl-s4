<div id="content">

    <!-- Topbar -->
    @include('layouts.admin-partials.topbar')
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
        @stack('notif')
        @yield('main-content')

    </div>
    <!-- /.container-fluid -->

</div>
