<!-- resources/views/components/navbar.blade.php -->
<style>
  .nav-hover:hover {
    background-color: #004878;
    color: white;
    border-radius: 9px;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark navbar-light sticky-top" style="background-color: #004878;">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('landing') }}">
      <img src="{{asset('img/logo-poliwangi.png')}}" alt="Logo" class="mr-2" style="width: 65px; height: auto">
      <img src="{{asset('img/poliwangi-white.svg')}}" alt="Job Fair Logo" width="170" height=auto class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
      @if (Route::has('login'))
          @auth
          <li class="nav-item">
            <a class="nav-link fw-bold nav-hover" href="{{ route('home') }}">Dasbor</a>
          </li>
          <!--
          <li class="nav-item">
            <form id="GFG" action="{{ route('logout') }}" method="POST" style="display: inline;">
              @csrf
              <a class="nav-link fw-bold nav-hover" href="javascript:$('GFG').submit();"> 
                Logout
              </a> 
            </form>
          </li>
          -->
          @else
          <li class="nav-item">
            <a class="nav-link fw-bold nav-hover" href="{{ route('login') }}">Masuk</a>
          </li>
              @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link fw-bold nav-hover" href="{{ route('register') }}">Daftar</a>
              </li>
              @endif
          @endauth
        @endif
      </ul>
    </div>
  </div>
</nav>
