@extends('layouts.main')

@section('title', $company->user->name)

@section('content')
<!-- Company Header -->
<div class="company-header py-5" style="background: linear-gradient(180deg, #D3E1E9 0%, #ffffff 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 mb-4 mb-lg-0 text-center text-lg-start">
                <div class="company-logo-wrapper mx-auto mx-lg-0">
                    @if($company->user->avatar)
                        <img src="{{ asset(str_replace('public/', '', 'storage/' . $company->user->avatar)) }}"
                             alt="{{ $company->user->name }}"
                             class="company-logo rounded-circle shadow">
                    @else
                        <div class="company-logo-placeholder rounded-circle shadow d-flex align-items-center justify-content-center bg-light">
                            <i class="fas fa-building fa-3x text-muted"></i>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-9 text-center text-lg-start">
                <h1 class="h2 mb-2">{{ $company->user->name }}</h1>
                <p class="text-muted mb-4">
                    <i class="fas fa-map-marker-alt me-2"></i>{{ $company->address }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Company Content -->
<div class="company-content flex-grow-1">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Company Description -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="h5 card-title fw-bold mb-4">
                            <i class="fas fa-info-circle me-2"></i>Tentang Perusahaan
                        </h2>
                        <p class="card-text text-muted">{!! $company->description !!}</p>
                    </div>
                </div>

                <!-- Company Details -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="h5 card-title fw-bold mb-4">
                            <i class="fas fa-briefcase me-2"></i>Informasi Perusahaan
                        </h2>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper me-3">
                                        <i class="fas fa-globe text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Website</small>
                                        <a href="{{ $company->website ?? '#' }}" target="_blank" rel="noopener noreferrer">
                                            {{ $company->website ?? 'Tidak tersedia' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper me-3">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Email</small>
                                        <a href="mailto:{{ $company->email ?? '' }}">
                                            {{ $company->user->email ?? 'Tidak tersedia' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Company Events -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="h5 card-title fw-bold mb-4">
                            <i class="fas fa-calendar-alt me-2"></i>Event Perusahaan
                        </h2>
                        @if($events->isNotEmpty())
                            <div class="row g-4">
                                @foreach($events as $event)
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-img-wrapper">
                                                @if($event->image)
                                                    <img src="{{ asset(str_replace('public/', '', 'storage/' . $event->image)) }}"
                                                         class="card-img-top" alt="{{ $event->name }}"
                                                         style="height: 150px; object-fit: cover;">
                                                @else
                                                    <div class="placeholder-img bg-light d-flex align-items-center justify-content-center"
                                                         style="height: 150px;">
                                                        <i class="fas fa-calendar-alt fa-3x text-muted"></i>
                                                    </div>
                                                @endif
                                                @if($event->status === 'open')
                                                    <div class="event-badge">
                                                        <span class="badge bg-success">Active</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <h3 class="h6 card-title mb-3">{{ $event->name }}</h3>
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                                    <small class="text-muted">
                                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }} -
                                                        {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                                                    </small>
                                                </div>
                                                @if($event->status === 'open')
                                                    <a href="{{ route('event.show', $event->id) }}"
                                                       class="btn btn-outline-primary btn-sm w-100">
                                                        Lihat Detail
                                                    </a>
                                                @else
                                                    <button class="btn btn-outline-secondary btn-sm w-100" disabled>
                                                        Event Selesai
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <img src="{{ asset('img/no-events.svg') }}" alt="No Events"
                                     class="mb-3" style="max-width: 150px;">
                                <h4 class="text-muted">Belum ada event yang tersedia</h4>
                                <p class="text-muted mb-0">Perusahaan ini belum memiliki event yang aktif.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Open Vacancies -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 card-title fw-bold mb-4">
                            <i class="fas fa-briefcase me-2"></i>Lowongan Terbuka
                        </h3>
                        @if($openVacancies->count() > 0)
                            @foreach($openVacancies as $vacancy)
                                <div class="vacancy-item p-3 mb-3 rounded-3 border">
                                    <h4 class="h6 mb-2">{{ $vacancy->position }}</h4>
                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <small>{{ $vacancy->location }}</small>
                                    </div>
                                    <a href="{{ route('vacancy.show', $vacancy->id) }}"
                                       class="btn btn-outline-primary btn-sm w-100">
                                        Lihat Detail
                                    </a>
                                </div>
                            @endforeach
                            @if($openVacancies->count() > 3)
                                <a href="{{ route('company.vacancies', $company->id) }}" class="btn btn-link text-primary w-100">
                                    Lihat Semua Lowongan
                                </a>
                            @endif
                        @else
                            <p class="text-muted mb-0">Tidak ada lowongan terbuka saat ini.</p>
                        @endif
                    </div>
                </div>


                <!-- Company Social Media
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="h5 card-title fw-bold mb-4">
                            <i class="fas fa-share-alt me-2"></i>Media Sosial
                        </h3>
                        <div class="d-flex flex-wrap gap-2">
                            @if($company->linkedin)
                                <a href="{{ $company->linkedin }}" target="_blank" rel="noopener noreferrer"
                                   class="btn btn-outline-primary">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            @endif
                            @if($company->facebook)
                                <a href="{{ $company->facebook }}" target="_blank" rel="noopener noreferrer"
                                   class="btn btn-outline-primary">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif
                            @if($company->twitter)
                                <a href="{{ $company->twitter }}" target="_blank" rel="noopener noreferrer"
                                   class="btn btn-outline-primary">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                            @if($company->instagram)
                                <a href="{{ $company->instagram }}" target="_blank" rel="noopener noreferrer"
                                   class="btn btn-outline-primary">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>

<style>
.company-header {
    position: relative;
    overflow: hidden;
}

.company-logo,
.company-logo-placeholder {
    width: 200px;
    height: 200px;
    object-fit: cover;
}

.icon-wrapper {
    width: 40px;
    height: 40px;
    background-color: rgba(0, 72, 120, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-img-wrapper {
    position: relative;
    overflow: hidden;
}

.event-badge {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
}

.vacancy-item,
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.vacancy-item:hover,
.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}

.company-content {
    min-height: calc(100vh - 400px);
}

@media (max-width: 992px) {
    .company-logo,
    .company-logo-placeholder {
        width: 160px;
        height: 160px;
    }
}
</style>
@endsection
