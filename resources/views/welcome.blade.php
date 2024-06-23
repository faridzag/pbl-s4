@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    <!-- Blade: Fullscreen Background -->
    <div class="position-relative vh-100">
        <!-- Gambar Latar Belakang dengan Blur -->
        <img src="{{asset('admin/img/background-gedung.jpg')}}" class="position-absolute w-100 h-100" style="object-fit: cover; filter: blur(3px);" alt="Background">
    </div>

    <!-- Blade: Job Fair Yang Berlangsung -->
    <div class="container-fluid bg-light" id="content" style="margin-top: 50px;">
        <div class="container py-5">
            <div class="d-flex justify-content-between mb-4">
                <h2>Event yang akan datang</h2>
                <a href="{{ route('event') }}" class="btn btn-primary">Lihat Lebih Banyak</a>
            </div>
            
            <div class="row justify-content-center">
            @if (count($events) > 0)  
                <div class="row">
                @foreach ($events as $event)
                    <div class="col-lg-4 mb-4">
                        <div class="card border-0 rounded shadow">
                            <img src="https://via.placeholder.com/400x150" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">{{ $event->start_date }}</p> <h5 class="card-title">{{ $event->name }}</h5> <span><i class="fas fa-map-marker-alt mr-2"></i>{{ $event->location }}</span> </div>
                            </div>
                        </div>
                    @if ($loop->iteration === 3) @break
                        @endif
                @endforeach
                    </div>
            @else
                <p>Tidak ada event.</p>
            @endif
            </div>
        </div>
    </div>

    <!-- Blade: Perusahaan Terdaftar -->
    <div class="container-fluid bg-light" id="perusahaan-terdaftar" style="margin-top: 50px;">
        <div class="container py-5">
            <div class="d-flex justify-content-between mb-4">
                <h2>Perusahaan Terdaftar</h2>
            </div>
            <div class="row justify-content-center">
            @if (count($companies) > 0)
                <div class="row">
                    @foreach ($companies as $company)
                        <div class="col-lg-4 mb-4">
                            <div class="card border-0 rounded shadow">
                                <img src="https://via.placeholder.com/400x150" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="{{ route('companies.show', $company->id) }}" class="card-title text-decoration-none">
                                        <p class="card-text"><strong>{{ $company->user->fullname }}</strong></p>
                                        <p class="card-text">{{ Str::limit($company->description, 50) }}</p>
                                        <span><i class="fas fa-map-marker-alt mr-2"></i>{{ $company->address }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $companies->links() }}  
            @else
                <p>Tidak ada perusahaan yang aktif.</p>
            @endif
            </div>
        </div>
    </div>
@endsection