@extends('layouts.main')

@section('title', $vacancy->position . ' - ' . $vacancy->company->user->name)

@section('content')
<div class="vacancy-header py-4" style="background: linear-gradient(180deg, #D3E1E9 0%, #ffffff 100%);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('landing') }}" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('event.show', $vacancy->event->id) }}" class="text-decoration-none">{{ $vacancy->event->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $vacancy->position }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4">
    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Job Header -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="company-logo me-3">
                            @if($vacancy->company->user->avatar)
                                <img src="{{ asset(str_replace('public/', '', 'storage/' . $vacancy->company->user->avatar)) }}"
                                     class="rounded-3" style="width: 80px; height: 80px; object-fit: cover;"
                                     alt="{{ $vacancy->company->user->name }}">
                            @else
                                <div class="rounded-3 bg-light d-flex align-items-center justify-content-center"
                                     style="width: 80px; height: 80px;">
                                    <i class="fas fa-building fa-2x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h1 class="h3 mb-2">{{ $vacancy->position }}</h1>
                            <p class="mb-0 text-primary fw-bold">{{ $vacancy->company->user->name }}</p>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        @if($vacancy->type)
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper me-2">
                                    <i class="fas fa-briefcase text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Tipe Pekerjaan</small>
                                    <span>{{ $vacancy->type }}</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($vacancy->experience_level)
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper me-2">
                                    <i class="fas fa-user-graduate text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Pengalaman</small>
                                    <span>{{ $vacancy->experience_level }}</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper me-2">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Lokasi</small>
                                    <span>{{ $vacancy->company->address }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @auth
                        @if (Auth::user()->role === 'APPLICANT')
                            @if (!$applicant->applications()->where('vacancy_id', $vacancy->id)->exists())
                                <form method="POST" action="{{ route('apply.job') }}" class="d-grid gap-2">
                                    @csrf
                                    <input type="hidden" name="vacancy_id" value="{{ $vacancy->id }}">
                                    <input type="hidden" name="company_id" value="{{ $vacancy->company->id }}">
                                    <input type="hidden" name="event_id" value="{{ $vacancy->event->id }}">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Lamar Sekarang
                                    </button>
                                </form>
                            @else
                                <div class="alert alert-info d-flex align-items-center" role="alert">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <div>Anda sudah melamar untuk lowongan ini.</div>
                                </div>
                            @endif
                        @else
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <div>Anda tidak dapat melamar karena bukan pelamar.</div>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <div>
                                Silakan <a href="{{ route('login') }}" class="alert-link">login</a> untuk melamar pekerjaan ini.
                            </div>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Job Description -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="h4 card-title fw-bold mb-4">Deskripsi Lowongan</h2>
                    <div class="job-description">
                        {!! $vacancy->description !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Company Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="h5 card-title fw-bold mb-4">Tentang Perusahaan</h3>
                    <div class="company-info">
                        <p class="text-muted mb-3">{!! Str::limit($vacancy->company->description, 250) !!}</p>
                        <a href="{{ route('company.profile', $vacancy->company->id) }}"
                           class="btn btn-outline-primary w-100">
                            <i class="fas fa-building me-2"></i>Lihat Profil Perusahaan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Similar Vacancies -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="h5 card-title fw-bold mb-4">Lowongan Serupa</h3>
                    @if ($similarVacancies->count() > 0)
                        <div class="similar-vacancies">
                            @foreach ($similarVacancies as $similarVacancy)
                                <div class="vacancy-item p-3 mb-3 rounded-3 border">
                                    <h4 class="h6 mb-2">{{ $similarVacancy->position }}</h4>
                                    <div class="d-flex align-items-center text-muted mb-3">
                                        <i class="fas fa-building me-2"></i>
                                        <small>{{ $similarVacancy->company->user->name }}</small>
                                    </div>
                                    <a href="{{ route('vacancy.show', $similarVacancy->id) }}"
                                       class="btn btn-outline-primary btn-sm w-100">
                                        Lihat Detail
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <img src="{{ asset('img/no-vacancies.svg') }}" alt="No Vacancies"
                                 class="mb-3" style="max-width: 150px;">
                            <p class="text-muted mb-0">Tidak ada lowongan serupa saat ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.vacancy-header {
    position: relative;
    overflow: hidden;
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

.icon-wrapper i {
    font-size: 1.2rem;
}

.job-description {
    font-size: 1rem;
    line-height: 1.6;
    color: #4a5568;
}

.job-description ul {
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}

.vacancy-item {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.vacancy-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
}

.breadcrumb-item a {
    color: #004878;
}

.breadcrumb-item.active {
    color: #6c757d;
}

@media (max-width: 768px) {
    .row.g-4 {
        --bs-gutter-y: 2rem;
    }
}
</style>
@endsection
