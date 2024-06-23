@extends('layouts.main')

@section('title', 'Kegiatan')

@section('content')
    <!-- Blade: Fullscreen Background -->
    <div class="position-relative vh-100">
        <!-- Gambar Latar Belakang dengan Blur -->
        <img src="{{asset('img/background-gedung.jpg')}}" class="position-absolute w-100 h-100" style="object-fit: cover; filter: blur(3px);" alt="Background">
    </div>

    <div class="container-fluid bg-light mt-1" id="content">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-3 mb-2">
                    <h5 class="fw-bold">Tipe</h5>
                    <select class="form-select mt-2">
                        <option selected>Tipe Job Fair</option>
                        <option value="1">Online</option>
                        <option value="2">Offline</option>
                    </select>
                </div>
                <div class="col-lg-3 mb-2">
                    <h5 class="fw-bold">Tanggal Mulai</h5>
                    <input type="date" class="form-control mt-2">
                </div>
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
                @endforeach
                    </div>
                {{ $events->links() }}  
            @else
                <p>Tidak ada event.</p>
            @endif
            </div>
    </div>
@endsection