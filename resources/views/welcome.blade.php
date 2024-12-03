@extends('layouts.main')
@section('title', 'Selamat Datang')

@section('content')
<!-- Hero Section with Overlay -->
<div class="position-relative hero-section">
    <img src="{{asset('img/background-gedung.jpg')}}" class="hero-image" alt="Poliwangi Campus">
    <div class="hero-overlay">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-8 text-white">
                    <h1 class="display-4 fw-bold mb-4">Temukan Karir Impianmu</h1>
                    <p class="lead mb-4">Platform job fair dan rekrutmen kampus untuk menghubungkan talent terbaik dengan perusahaan ternama</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Mulai Sekarang</a>
                        <a href="#event-section" class="btn btn-outline-light btn-lg">Lihat Event</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upcoming Events Section -->
<div class="container-fluid bg-light py-5" id="event-section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h2 class="section-title">Event yang akan datang</h2>
                <p class="text-muted">Jelajahi berbagai event karir yang akan datang</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <form action="{{ route('landing') }}" method="GET" id="eventFilterForm"  class="d-flex align-items-center gap-2">
                    <select name="event_type" class="form-select" style="width: auto;">
                        <option value="">Semua Kegiatan</option>
                        <option value="Job Fair" {{ request('event_type') === 'Job Fair' ? 'selected' : '' }}>Job Fair</option>
                        <option value="Campus Hiring" {{ request('event_type') === 'Campus Hiring' ? 'selected' : '' }}>Campus Hiring</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('landing') }}" class="btn btn-secondary">Reset</a>
                </form>
            </div>
        </div>

        <div class="row g-4">
            @if (count($events) > 0)
                @foreach ($events as $event)
                    <div class="col-md-6 col-lg-4">
                        <div class="card event-card h-100 border-0 shadow-sm">
                            <div class="card-img-wrapper">
                                @if($event->image)
                                    <img src="{{ asset(str_replace('public', '', 'storage' . $event->image)) }}"
                                         class="card-img-top" alt="{{ $event->name }}">
                                @else
                                    <img src="https://via.placeholder.com/400x200"
                                         class="card-img-top" alt="{{ $event->name }}">
                                @endif
                                <div class="card-img-overlay d-flex align-items-end">
                                    <span class="badge bg-primary mb-2">{{ $event->event_type }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</small>
                                </div>
                                <h5 class="card-title mb-3">{{ $event->name }}</h5>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <small class="text-muted">{{ $event->location }}</small>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <a href="{{ route('event.show', $event->id) }}"
                                   class="btn btn-outline-primary w-100">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 mt-4">
                    {{ $events->onEachSide(3)->links() }}
                </div>
            @else
                <div class="col-12 text-center py-5">
                    <img src="{{ asset('img/no-events.svg') }}" alt="Tidak ada kegiatan" class="mb-3" style="max-width: 200px;">
                    <h4>Tidak ada event saat ini</h4>
                    <p class="text-muted">Silakan cek kembali nanti</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Registered Companies Section -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="section-title">Perusahaan Terdaftar</h2>
                <p class="text-muted">Berbagai perusahaan ternama telah bergabung dengan kami</p>
            </div>
        </div>

        <div class="row g-4">
            @if (count($companies) > 0)
                @foreach ($companies as $company)
                    <div class="col-md-6 col-lg-4">
                        <div class="card company-card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="company-logo me-3">
                                        @if($company->user->avatar)
                                            <img src="{{ asset(str_replace('public/', '', 'storage/' . $company->user->avatar)) }}"
                                                 alt="{{ $company->user->name }}" class="rounded-circle">
                                        @else
                                            <div class="placeholder-logo rounded-circle bg-light d-flex align-items-center justify-content-center">
                                                <i class="fas fa-building text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0">{{ $company->user->name }}</h5>
                                        <small class="text-muted">{{ $company->website }}</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-3">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <small class="text-muted">{{ $company->address }}</small>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <a href="{{ route('company.profile', $company->id) }}"
                                   class="btn btn-outline-primary w-100">Lihat Profil</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 mt-4">
                    {{ $companies->onEachSide(3)->links() }}
                </div>
            @else
                <div class="col-12 text-center py-5">
                    <img src="{{ asset('img/no-companies.svg') }}" alt="Tidak ada perusahaan terdaftar" class="mb-3" style="max-width: 200px;">
                    <h4>Tidak ada perusahaan terdaftar</h4>
                    <p class="text-muted">Silakan cek kembali nanti</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
.hero-section {
    height: 80vh;
    min-height: 500px;
    overflow: hidden;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(rgba(0,72,120,0.8), rgba(0,72,120,0.9));
}

.section-title {
    position: relative;
    padding-bottom: 15px;
    margin-bottom: 15px;
}

.section-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 3px;
    background-color: #004878;
}

.event-card .card-img-wrapper {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.event-card .card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.event-card:hover .card-img-top {
    transform: scale(1.05);
}

.company-card .company-logo img,
.company-card .placeholder-logo {
    width: 60px;
    height: 60px;
    object-fit: cover;
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}

@media (max-width: 768px) {
    .hero-section {
        height: 60vh;
    }
}
</style>

<!-- Custom JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>
@endsection
