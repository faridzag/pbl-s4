@extends('layouts.main')

@section('title', 'Event Perusahaan')

@section('content')
<div class="py-5" style="background-color: #D3E1E9;">
    <div class="container">
        <div class="row align-items-center text-center text-md-start">
        <div class="col-md-4 mb-3 mb-md-0">
              @if (isset($company->image))
                  <img src="{{ asset(str_replace('public/', '', 'storage/' . $company->image)) }}" alt="{{ $company->user->fullname }}" width="280" height="280" class="rounded-circle shadow-4-strong position-absolute-left mx-auto mx-md-0">
              @else
                  <img src="{{asset('img/somethinc-logo.jpeg')}}" alt="Perusahaan" width="280" height="280" class="img-fluid mx-auto mx-md-0">
              @endif
        </div>
            <div class="col-md-8 mt-5">
                <div class="text-container">
                    <h3 class="mb-1">{{ $company->user->fullname }}</h3>
                    <p class="text-secondary mb-5"><i class="bi bi-geo-alt-fill"></i>{{ $company->address}}</p>
                    <a href="{{ route('company.profile', $company->id) }}" class="btn border-secondary me-2 nav-hover">PROFILE</a>
                    <a href="{{ route('company.event', $company->id) }}" class="btn border-secondary nav-hover">EVENT</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Event Section -->
<div class="bg-white py-5">
    <div class="container">
        <h2 class="mb-5 text-start">Event List</h2>
        @if ($events->isNotEmpty())
            @foreach ($events as $event)
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="row g-0">
                                <div class="col-md-1">
                                    <img src="{{ asset(str_replace('public/', '', 'storage/' . $event->image)) }}" alt="{{ $event->name }}" class="img-fluid rounded-start ms-2 mt-2" style="width: 100px; height: auto;">
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body">
                                        <p class="card-text fw-bold small">{{ $event->name }}</p>
                                        <p class="card-text small"><i class="bi bi-clock-fill"></i>{{ \Carbon\Carbon::parse($event->start_date)->format('d-M-Y') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d-M-Y') }}</p>
                                        @if ($event->status === 'open')
                                            <a href="{{ route('event.show', $event->id) }}" class="text-dark">Selengkapnya</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>This company has no upcoming events.</p>
        @endif
    </div>
</div>
@endsection