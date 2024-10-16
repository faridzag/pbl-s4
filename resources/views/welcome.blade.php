@extends('layouts.main')
<!-- TODO -->
@section('title', 'Selamat Datang')

@section('content')
    <!-- Blade: Fullscreen Background -->
    <div class="position-relative vh-100">
        <!-- Gambar Latar Belakang dengan Blur -->
        <img src="{{asset('img/background-gedung.jpg')}}" class="position-absolute w-100 h-100" style="object-fit: cover;" alt="Background">
    </div>

    <!-- Blade: Job Fair Yang Berlangsung -->
    <div class="container-fluid bg-light" id="content">
        <div class="container py-5">
            <div class="flex justify-content mb-4">
                <h2>Event yang akan datang</h2>
                <!-- TODO:
                <div class="row">
                    <div class="col-lg-3">
                        <h5 class="fw-bold">Tipe</h5>
                        <select class="form-select mt-2">
                            <option selected>-</option>
                            <option value="1">Campus Hiring</option>
                            <option value="2">Job Fair</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <h5 class="fw-bold">Tanggal Mulai</h5>
                        <input type="date" class="form-control mt-2">
                    </div>
                </div>
                -->
            </div>

            <div class="row justify-content-center">
            @if (count($events) > 0)
                <div class="row">
                @foreach ($events as $event)
                    <div class="col-lg-4 mb-4">
                        <div class="card border-0 rounded shadow">
                            <a href="{{ route('event.show', $event->id) }}" class="card-title text-decoration-none">
                                @if($event->image)
                                    <img src="{{ asset(str_replace('public', '', 'storage/' . $event->image)) }}" class="card-img-top img-fluid" style="height: 150px;" alt="{{ $event->name }}">
                                @else
                                    <img src="https://via.placeholder.com/400x150" class="card-img-top img-fluid" style="height: 150px;" alt="{{ $event->name }}">
                                @endif
                                <div class="card-body">
                                    <p class="card-text">{{ $event->start_date }}</p> <h5 class="card-title">{{ $event->name }}</h5> <span><i class="fas fa-map-marker-alt mr-2"></i>{{ $event->location }}</span> </div>
                                </div>
                            </a>
                        </div>
                    @if ($loop->iteration === 3) @break
                        @endif
                @endforeach
                    </div>
                    {{ $events->onEachSide(3)->links() }}
                </div>
            @else
                <p>Tidak ada event.</p>
            @endif
            </div>
        </div>
    </div>

    <div class="container-fluid bg-light" id="perusahaan-terdaftar">
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
                                <a href="{{ route('company.profile', $company->id) }}" class="card-title text-decoration-none">
                                    @if($company->user->avatar)
                                        <img src="{{ asset(str_replace('public/', '', 'storage/' . $company->user->avatar)) }}" class="card-img-top img-fluid" style="height: 150px;" alt="{{ $company->user->name }}">
                                    @else
                                        <img src="https://via.placeholder.com/400x150" class="card-img-top img-fluid" style="height: 150px;" alt="{{ $company->name }}">
                                    @endif
                                    <div class="card-body">
                                            <p class="card-text"><strong>{{ $company->user->name }}</strong></p>
                                            <p class="card-text">{{ Str::limit($company->description, 50) }}</p>
                                            <span><i class="fas fa-map-marker"></i>{{ $company->address }}</span>
                                        </a>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $companies->onEachSide(3)->links() }}
            @else
                <p>Tidak ada perusahaan yang aktif.</p>
            @endif
            </div>
        </div>
    </div>
@endsection
