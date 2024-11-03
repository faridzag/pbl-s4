@extends('layouts.main')

@section('title', $event->name)

@section('content')
<!-- Event Header -->
<div class="event-header py-5" style="background: linear-gradient(180deg, #D3E1E9 0%, #ffffff 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="event-image-wrapper">
                    @if($event->image)
                        <img src="{{ asset(str_replace('public/', '', 'storage/' . $event->image)) }}"
                             class="img-fluid rounded-3 shadow" alt="{{ $event->name }}">
                    @else
                        <img src="{{asset('img/campus-hiring.jpg')}}"
                             class="img-fluid rounded-3 shadow" alt="Event Image">
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ps-lg-4">
                    <h1 class="display-5 fw-bold mb-3">{{ $event->name }}</h1>
                    <div class="event-details">
                        <div class="d-flex align-items-center mb-3">
                            <div class="event-icon-wrapper me-3">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted">Lokasi</p>
                                <h6 class="mb-0">{{ $event->location }}</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="event-icon-wrapper me-3">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted">Tanggal</p>
                                <h6 class="mb-0">
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Event Content -->
<div class="container py-5">
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8 mb-4 mb-lg-0">
            <!-- About Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="card-title h4 fw-bold mb-4">Tentang {{ $event->name }}</h2>
                    <div class="event-description">
                        {!! $event->description !!}
                    </div>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title h4 fw-bold mb-4">Lowongan Tersedia</h2>
                    @if ($companies->count() > 0)
                        <div class="job-listings">
                            @foreach ($companies as $company)
                                @if ($company->vacancies->where('status', 'open')->where('event_id', $event->id)->count() > 0)
                                    <div class="company-section mb-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="company-logo me-3">
                                                @if($company->user->avatar)
                                                    <img src="{{ asset(str_replace('public/', '', 'storage/' . $company->user->avatar)) }}"
                                                         class="rounded-circle" style="width: 48px; height: 48px; object-fit: cover;"
                                                         alt="{{ $company->user->name }}">
                                                @else
                                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                                         style="width: 48px; height: 48px;">
                                                        <i class="fas fa-building text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <h5 class="mb-0 fw-bold">{{ $company->user->name }}</h5>
                                        </div>

                                        <div class="vacancy-list">
                                            @foreach ($company->vacancies->where('status', 'open') as $vacancy)
                                                @if ($vacancy->event_id === $event->id)
                                                    <div class="vacancy-card p-3 mb-3 rounded-3 border">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div>
                                                                <h6 class="text-primary fw-bold mb-2">{{ $vacancy->position }}</h6>
                                                                <p class="text-muted mb-2">{!! Str::limit($vacancy->description, 250) !!}</p>
                                                                <div class="vacancy-tags">
                                                                    @if($vacancy->type)
                                                                        <span class="badge bg-light text-dark me-2">{{ $vacancy->type }}</span>
                                                                    @endif
                                                                    @if($vacancy->experience_level)
                                                                        <span class="badge bg-light text-dark">{{ $vacancy->experience_level }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <a href="{{ route('vacancy.show', $vacancy->id) }}"
                                                               class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        {{ $companies->links() }}
                    @else
                        <div class="text-center py-4">
                            <img src="{{ asset('img/no-jobs.svg') }}" alt="No Jobs" class="mb-3" style="max-width: 150px;">
                            <h5 class="text-muted">Belum ada lowongan tersedia</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title h4 fw-bold mb-4">Perusahaan Terdaftar</h2>
                    @if ($companies->count() > 0)
                        <div class="company-list">
                            @foreach ($companies as $company)
                                <div class="company-card p-3 mb-3 rounded-3 border">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="company-logo me-3">
                                                @if($company->user->avatar)
                                                    <img src="{{ asset(str_replace('public/', '', 'storage/' . $company->user->avatar)) }}"
                                                         class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;"
                                                         alt="{{ $company->user->name }}">
                                                @else
                                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-building text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-1 fw-bold">{{ $company->user->name }}</h6>
                                                <span class="badge bg-warning text-dark">
                                                    {{ $company->vacancies()->where('event_id', $event->id)->where('status', 'open')->count() }}
                                                    Lowongan
                                                </span>
                                            </div>
                                        </div>
                                        <a href="{{ route('company.profile', $company->id) }}"
                                           class="btn btn-link text-dark p-0">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <img src="{{ asset('img/no-companies.svg') }}" alt="No Companies" class="mb-3" style="max-width: 150px;">
                            <h5 class="text-muted">Belum ada perusahaan terdaftar</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.event-header {
    position: relative;
    overflow: hidden;
}

.event-icon-wrapper {
    width: 40px;
    height: 40px;
    background-color: rgba(0, 72, 120, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.event-icon-wrapper i {
    color: #004878;
    font-size: 1.2rem;
}

.event-image-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 1rem;
}

.event-image-wrapper::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 100%);
    pointer-events: none;
}

.vacancy-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.vacancy-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
}

.company-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.company-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
}

@media (max-width: 992px) {
    .event-header {
        text-align: center;
    }

    .event-details {
        justify-content: center;
    }
}
</style>
@endsection
