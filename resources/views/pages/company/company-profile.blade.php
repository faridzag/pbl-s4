@extends('layouts.main')

@section('title', 'Profil Perusahaan')

@section('content')
  <div class="py-5" style="background-color: #D3E1E9;">
    <div class="container">
      <div class="row align-items-center text-center text-md-start">
        <div class="col-md-4 mb-3 mb-md-0">
              @if (isset($company->user->avatar))
                  <img src="{{ asset(str_replace('public/', '', 'storage/' . $company->user->avatar)) }}" alt="{{ $company->user->name }}" width="280" height="280" class="rounded-circle shadow-4-strong position-absolute-left mx-auto mx-md-0">
              @else
                  <img src="{{asset('img/somethinc-logo.jpeg')}}" alt="Perusahaan" width="280" height="280" class="img-fluid mx-auto mx-md-0">
              @endif
        </div>

        <div class="col-md-8 mt-5">
          <div class="col-md-8 mt-3"> <!-- mengurangi margin atas dari 5 menjadi 3 -->
            <div class="text-container">
              <h3 class="mb-1">{{ $company->user->name }}</h3> <!-- mengurangi margin bawah dari h3 -->
              <p class="text-secondary mb-5"><i class="bi bi-geo-alt-fill">{{ $company->address }}</i></p>
              <a href="{{ route('company.profile', $company->id) }}" class="btn border-secondary me-2 nav-hover">PROFILE</a>
              <a href="{{ route('company.event', $company->id) }}" class="btn border-secondary nav-hover">EVENT</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-white py-5">
    <div class="container">
      <!-- Company Description Section -->
      <div class="row">
        <div class="col-12">
          <h5>Deskripsi Perusahaan</h5>
          <p>{{ $company->description}}</p>
        </div>
      </div>
    </div>
  </div>
@endsection
