<!-- resources/views/components/navbar.blade.php -->
<style>
  .nav-hover:hover {
    background-color: #004878;
    color: white;
    border-radius: 9px;
  }
</style>
<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color: #D3E1E9;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="{{asset('admin/img/logo-poliwangi.png')}}" alt="Logo" class="mr-2" style="width: 65px; height: auto">
      <img src="{{asset('admin/img/poliwangi-logo-text-only.svg')}}" alt="Job Fair Logo" width="170" height=auto class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link fw-bold nav-hover" aria-current="page" href="#">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold nav-hover" href="#">Job Fair</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold nav-hover" href="#">Perusahaan</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link fw-bold nav-hover" href="{{ route('register') }}">Daftar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold nav-hover" href="{{ route('login') }}">Masuk</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
